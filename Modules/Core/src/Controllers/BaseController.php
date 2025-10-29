<?php

namespace Modules\Core\Controllers;

use AllowDynamicProperties;
use App\Http\Controllers\Controller as MXController;
use Modules\Core\Services\SettingsService;

#[AllowDynamicProperties]
class BaseController extends MXController
{
    /** @var bool */
    public $ajax_controller = false;

    /**
     * Modules\Core\Controllers\Base_Controller constructor.
     */
    public function __construct()
    {
        // Don't allow non-ajax requests to ajax Controllers
        if ($this->ajax_controller && ! request()->ajax()) {
            abort(403);
        }

        // Globally disallow GET requests to delete methods
        if (mb_strstr(request()->url(), 'delete') && request()->method() !== 'POST') {
            abort(404);
        }

        // Check if database has been configured
        if ( ! env_bool('SETUP_COMPLETED')) {
            redirect()->route('/welcome');
        } else {
            // Load setting model and load settings
            if ($this->mdl_settings != null) {
                (new SettingsService())->loadSettings();
            }

            // Load the lang based on user config, fall back to system if needed
            $user_lang = session()->get('user_language');
            if (empty($user_lang) || $user_lang == 'system') {
                set_language(get_setting('default_language'));
            } else {
                set_language($user_lang);
            }
        }
    }
}
