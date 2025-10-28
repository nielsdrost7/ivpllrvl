<?php

declare(strict_types=1);

namespace Modules\Core\Http\Controllers;

use Modules\Core\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Modules\Core\Services\SessionsService;

class SessionsController extends Controller
{
    protected SessionsService $sessionsService;

    public function __construct(SessionsService $sessionsService)
    {
        $this->sessionsService = $sessionsService;
    }

    /**
     * Redirect index to login page.
     */
    public function index(): RedirectResponse
    {
        return redirect()->route('sessions.login');
    }

    /**
     * Display the login page.
     */
    public function login(Request $request): View|RedirectResponse
    {
        // Check if token is provided for password reset
        if ($request->has('token')) {
            $token = $request->input('token');
            
            // Validate token contains only alphanumeric and underscores
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $token)) {
                return redirect('/');
            }

            $user = User::where('user_passwordreset_token', $token)->first();
            
            if (!$user) {
                return redirect()->route('sessions.passwordreset')
                    ->with('alert_error', trans('core::messages.loginalert_invalid_token'));
            }

            return view('core::session_new_password', [
                'token' => $token,
                'user_id' => $user->user_id,
            ]);
        }

        return view('core::session_login', [
            'login_logo' => 'logo.png',
        ]);
    }

    /**
     * Authenticate user credentials.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        // This is just for compatibility with routes, redirect to login
        return redirect()->route('sessions.login');
    }

    /**
     * Handle login form submission.
     */
    public function loginPost(Request $request): RedirectResponse
    {
        if (!$request->has('btn_login')) {
            return redirect()->route('sessions.login');
        }

        $email = $request->input('email');
        $password = $request->input('password');

        // Check for login throttling
        $loginLog = DB::table('ip_login_log')
            ->where('login_name', $email)
            ->first();

        if ($loginLog) {
            // Check if 12 hours have passed
            $twelveHoursAgo = now()->subHours(12);
            $logTimestamp = \Carbon\Carbon::parse($loginLog->log_create_timestamp);

            if ($logTimestamp->lt($twelveHoursAgo)) {
                // Delete old log entry
                DB::table('ip_login_log')
                    ->where('login_name', $email)
                    ->delete();
            } elseif ($loginLog->log_count >= 10) {
                // Account is locked
                return redirect()->route('sessions.login')
                    ->with('alert_error', trans('core::messages.loginalert_account_locked'));
            }
        }

        // Find user
        $user = User::where('user_email', $email)->first();

        if (!$user) {
            $this->incrementLoginFailures($email);
            return redirect()->route('sessions.login')
                ->with('alert_error', trans('core::messages.loginalert_user_not_found'));
        }

        // Check if user is active
        if ($user->user_active != 1) {
            $this->incrementLoginFailures($email);
            return redirect()->route('sessions.login')
                ->with('alert_error', trans('core::messages.loginalert_user_inactive'));
        }

        // Attempt authentication
        if ($this->sessionsService->auth($email, $password)) {
            // Clear login failures on successful login
            DB::table('ip_login_log')
                ->where('login_name', $email)
                ->delete();

            // Redirect based on user type
            if ($user->user_type == 2) {
                return redirect()->route('guest');
            }

            return redirect()->route('dashboard');
        }

        // Authentication failed
        $this->incrementLoginFailures($email);
        return redirect()->route('sessions.login')
            ->with('alert_error', trans('core::messages.loginalert_invalid_credentials'));
    }

    /**
     * Log out the authenticated user.
     */
    public function logout(): RedirectResponse
    {
        session()->flush();
        auth()->logout();

        return redirect()->route('sessions.login');
    }

    /**
     * Display password reset page or process reset.
     */
    public function passwordreset(Request $request): View|RedirectResponse
    {
        if ($request->has('btn_new_password')) {
            return $this->processNewPassword($request);
        }

        if ($request->has('btn_reset')) {
            return $this->processSendResetEmail($request);
        }

        return view('core::session_passwordreset');
    }

    /**
     * Process sending password reset email.
     */
    protected function processSendResetEmail(Request $request): RedirectResponse
    {
        $email = $request->input('email');

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect('/');
        }

        // Check for throttling
        $loginLog = DB::table('ip_login_log')
            ->where('login_name', $email)
            ->first();

        if ($loginLog && $loginLog->log_count >= 10) {
            return redirect()->route('sessions.login')
                ->with('alert_error', trans('core::messages.loginalert_too_many_attempts'));
        }

        $user = User::where('user_email', $email)
            ->where('user_active', 1)
            ->first();

        if ($user) {
            // Generate reset token
            $token = Str::random(32);
            $user->user_passwordreset_token = $token;
            $user->save();

            // Send email (simplified for now)
            Mail::raw("Password reset link: " . route('sessions.passwordreset', ['token' => $token]), function ($message) use ($user) {
                $message->to($user->user_email)
                    ->subject('Password Reset');
            });
        }
        
        // Always increment attempt counter for password resets (security measure)
        $this->incrementLoginFailures($email);

        return redirect()->route('sessions.login')
            ->with('alert_success', trans('core::messages.loginalert_reset_email_sent'));
    }

    /**
     * Process setting new password.
     */
    protected function processNewPassword(Request $request): RedirectResponse
    {
        $token = $request->input('token');
        $userId = $request->input('user_id');
        $newPassword = $request->input('new_password');

        if (empty($newPassword)) {
            return redirect()->back()
                ->with('alert_error', trans('core::messages.loginalert_password_required'));
        }

        $user = User::where('id', $userId)
            ->where('user_passwordreset_token', $token)
            ->first();

        if (!$user) {
            return redirect()->back()
                ->with('alert_error', trans('core::messages.loginalert_invalid_token'));
        }

        // Update password
        $user->user_password = Hash::make($newPassword);
        $user->user_passwordreset_token = '';
        $user->save();

        return redirect()->route('sessions.login')
            ->with('alert_success', trans('core::messages.loginalert_password_updated'));
    }

    /**
     * Increment login failure count.
     */
    protected function incrementLoginFailures(string $email): void
    {
        $loginLog = DB::table('ip_login_log')
            ->where('login_name', $email)
            ->first();

        if ($loginLog) {
            DB::table('ip_login_log')
                ->where('login_name', $email)
                ->update([
                    'log_count' => $loginLog->log_count + 1,
                    'log_create_timestamp' => now(),
                ]);
        } else {
            DB::table('ip_login_log')->insert([
                'login_name' => $email,
                'log_count' => 1,
                'log_create_timestamp' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
