<?php

return [
    'activated'        => true, // active/inactive all logging
    'middleware'       => ['web', 'auth:dashboard', 'permission:view_activity_log'],
    'route_path'       => 'admin/activity-log',
    'admin_panel_path' => 'admin',
    'delete_limit'     => 7, // default 7 days

    'model' => [
        'user' => "App\Models\User",
    ],

    'log_events' => [
        'on_create'  => false,
        'on_edit'    => true,
        'on_delete'  => true,
        'on_login'   => true,
        'on_lockout' => true,
    ],
];
