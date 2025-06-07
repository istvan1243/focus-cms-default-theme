<?php

return [
    'options' => [
        //Témára vonatkozó alapvető adatok
        'theme' => [
            'ts_FocusDefaultTheme_title'    => 'nullable|string|max:255',
            'ts_FocusDefaultTheme_name'     => 'nullable|string|max:255',
        ],
        //Téma oldalsávok
        'sidebars' => [
            'ts_FocusDefaultTheme_sidebar_maintenance' => 'nullable|string',
            'ts_FocusDefaultTheme_sidebar_top_nav'     => 'nullable|string',
            'ts_FocusDefaultTheme_sidebar_bottom_1'    => 'nullable|string',
            'ts_FocusDefaultTheme_sidebar_bottom_2'    => 'nullable|string',
            'ts_FocusDefaultTheme_sidebar_bottom_3'    => 'nullable|string',
            'ts_FocusDefaultTheme_sidebar_bottom_4'    => 'nullable|string',
            'ts_FocusDefaultTheme_sidebar_head_source' => 'nullable|string',
        ]
    ]
];