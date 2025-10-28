<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\View\View;

use function Modules\Core\Http\Controllers\config;

use Modules\Core\Http\Controllers\CoreController;

use function Modules\Core\Http\Controllers\now;
use function Modules\Core\Http\Controllers\view;

use Modules\Invoices\Models\Invoice;
use Modules\Projects\Models\Project;
use Modules\Projects\Models\Task;
use Modules\Quotes\Models\Payment;

class DashboardController extends CoreController
{
    private const MIN_STATUS_ID = 1;

    private const MAX_STATUS_ID = 4;

    /**
     * Display the dashboard with overview data.
     */
    public function index(): View
    {
        // Get invoice overview period setting
        $invoiceOverviewPeriod = Setting::where('setting_key', 'invoice_overview_period')
            ->first()?->setting_value ?? 'all-time';

        // Get quote overview period setting
        $quoteOverviewPeriod = Setting::where('setting_key', 'quote_overview_period')
            ->first()?->setting_value ?? 'all-time';

        // Get invoice status totals
        $invoiceStatusTotals = $this->getInvoiceStatusTotals();

        // Get quote status totals
        $quoteStatusTotals = $this->getQuoteStatusTotals();

        // Get recent invoices (limited to 10)
        $invoices = Invoice::with('client')
            ->latest('invoice_date_created')
            ->limit(10)
            ->get();

        // Get recent quotes (limited to 10)
        $quotes = Payment::with('client')
            ->latest('quote_date_created')
            ->limit(10)
            ->get();

        // Get overdue invoices
        $overdueInvoices = Invoice::with('client')
            ->where('invoice_status_id', 2)
            ->where('invoice_date_due', '<', now())
            ->get();

        // Get latest projects
        $projects = Project::with('client')
            ->latest('created_at')
            ->limit(5)
            ->get();

        // Get latest tasks
        $tasks = Task::with('project')
            ->latest('created_at')
            ->limit(10)
            ->get();

        return view('core::dashboard.index', [
            'invoice_status_totals' => $invoiceStatusTotals,
            'quote_status_totals'   => $quoteStatusTotals,
            'invoices'              => $invoices,
            'quotes'                => $quotes,
            'overdue_invoices'      => $overdueInvoices,
            'projects'              => $projects,
            'tasks'                 => $tasks,
            'invoice_statuses'      => config('statuses.invoice'),
            'quote_statuses'        => config('statuses.quote'),
            'task_statuses'         => config('statuses.task'),
            'invoice_status_period' => str_replace('-', '_', $invoiceOverviewPeriod),
            'quote_status_period'   => str_replace('-', '_', $quoteOverviewPeriod),
        ]);
    }

    /**
     * Get invoice status totals.
     */
    private function getInvoiceStatusTotals(): array
    {
        $totals   = [];
        $statuses = config('statuses.invoice');

        for ($statusId = self::MIN_STATUS_ID; $statusId <= self::MAX_STATUS_ID; $statusId++) {
            $count    = Invoice::where('invoice_status_id', $statusId)->count();
            $sumTotal = Invoice::where('invoice_status_id', $statusId)->sum('invoice_total');

            $totals[] = [
                'status_id' => $statusId,
                'label'     => $statuses[$statusId]['label'] ?? 'Unknown',
                'count'     => $count,
                'sum_total' => $sumTotal,
                'href'      => "invoices/status/{$statusId}",
                'class'     => $statuses[$statusId]['class'] ?? '',
            ];
        }

        return $totals;
    }

    /**
     * Get quote status totals.
     */
    private function getQuoteStatusTotals(): array
    {
        $totals   = [];
        $statuses = config('statuses.quote');

        for ($statusId = self::MIN_STATUS_ID; $statusId <= self::MAX_STATUS_ID; $statusId++) {
            $count    = Payment::where('quote_status_id', $statusId)->count();
            $sumTotal = Payment::where('quote_status_id', $statusId)->sum('quote_total');

            $totals[] = [
                'status_id' => $statusId,
                'label'     => $statuses[$statusId]['label'] ?? 'Unknown',
                'count'     => $count,
                'sum_total' => $sumTotal,
                'href'      => "quotes/status/{$statusId}",
                'class'     => $statuses[$statusId]['class'] ?? '',
            ];
        }

        return $totals;
    }
}
