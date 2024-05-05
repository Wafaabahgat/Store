<?php


return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => '/dashboard',
        'title' => 'Dashboard',
        'active' => 'dashboard.dashboard',
    ],
    [
        'icon' => 'far fa-circle nav-icon',
        'route' => '/dashboard/categories',
        'title' => 'Category',
        'active' => 'dashboard.categories.*',
        'badge' => 'New'
    ],
    [
        'icon' => 'nav-icon fas fa-th',
        'route' => '/dashboard/Products',
        'title' => 'Products',
        'active' => 'dashboard.products.*',
    ],
];