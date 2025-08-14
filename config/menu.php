<?php

return [
    'main' => [
        [
            'type' => 'link',
            'id' => 'home',
            'label' => 'Home',
            'route' => 'dashboard',
            'icon' => 'home',
        ],
        [
            'type' => 'link',
            'id' => 'customers',
            'label' => 'Clienti',
            'route' => 'customers.index',
            'icon' => 'customers',
        ],
        [
            'type' => 'group',
            'id' => 'activity',
            'label' => 'Activity',
            'icon' => 'activity',
            'children' => [
                ['label' => 'Overview', 'route' => 'activity.overview', 'dot' => 'blue'],
                ['label' => 'Analytics', 'route' => 'activity.analytics', 'dot' => 'purple'],
                ['label' => 'Projects', 'route' => 'activity.projects', 'dot' => 'red'],
            ],
        ],
        [
            'type' => 'group',
            'id' => 'sales',
            'label' => 'Sales',
            'icon' => 'sales',
            'can' => 'view-sales',
            'children' => [
                ['label' => 'Preventivi', 'route' => 'sales.quotes', 'dot' => 'blue'],
                ['label' => 'Fatture', 'route' => 'sales.invoices', 'dot' => 'red'],
            ],
        ],
        [
            'type' => 'link',
            'id' => 'tasks',
            'label' => 'Tasks',
            'route' => 'tasks',
            'icon' => 'tasks',
        ],
        [
            'type' => 'link',
            'id' => 'reporting',
            'label' => 'Reporting',
            'route' => 'reporting',
            'icon' => 'reporting',
            'can' => 'view-reporting',
        ],
        [
            'type' => 'group',
            'id' => 'admin',
            'label' => 'Admin',
            'icon' => 'admin',
            'can' => 'manage-users',
            'children' => [
                ['label' => 'Utenti', 'route' => 'admin.users.index', 'dot' => 'blue'],
            ],
        ],
    ],
    'other' => [
        [
            'type' => 'link',
            'id' => 'help',
            'label' => 'Help',
            'route' => 'help',
            'icon' => 'help',
        ],
        [
            'type' => 'link',
            'id' => 'settings',
            'label' => 'Settings',
            'route' => 'settings',
            'icon' => 'settings',
        ],
    ],
];


