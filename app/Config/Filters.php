<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array<string, string>
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        // PERBAIKAN: Alias 'auth' dihapus.
        'isadmin'       => \App\Filters\IsAdmin::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array<string, array<string, array<string, string>>>
     */
    public array $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * @see https://codeigniter.com/user_guide/incoming/routing.html#matching-request-methods
     *
     * @var array<string, array<string, array<string, string>>>
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * specific routes or special areas.
     *
     * @var array<string, array<string, array<string, string>>>
     */
    public array $filters = [
        // Terapkan filter isadmin ke semua rute admin
        'isadmin' => [
            'before' => ['admin/*'],
        ],
    ];
}