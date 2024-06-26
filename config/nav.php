<?php


return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => '/admin/dashboard',
        'title' => 'Dashboard',
        'active' => 'dashboard.dashboard',
    ],
    [
        'icon' => 'far fa-circle nav-icon',
        'route' => '/admin/dashboard/categories',
        'title' => 'Category',
        'active' => 'dashboard.categories.*',
        'badge' => 'New'
    ],
    [
        'icon' => 'nav-icon fas fa-th',
        'route' => '/admin/dashboard/products',
        'title' => 'Products',
        'active' => 'dashboard.products.*',
    ],
];