<?php

use Illuminate\Validation\Rules\Password;

return [
    'renew_password_days_period' => env('FILAMENT_RENEW_PASSWORD_DAYS_PERIOD', 90),

    'renew_password_timestamp_column' => env('FILAMENT_RENEW_PASSWORD_TIMESTAMP_COLUMN', 'last_renew_password_at'),

    'password' => [
        'rules' => Password::default(),
    ],
];