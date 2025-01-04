<?php
return[
    [
        'icon'=>'nav-icon fas fa-tachometer-alt',
        'route'=>'dashboard.dashboard',
        'title'=>'Dashboard',
        'active'=>'dashboard.dashboard'

    ],
    [
        'icon'=>'fas fa-tags nav-icon',
        'route'=>'dashboard.categories.index',
        'title'=>'Categories',
        'active'=>'dashboard.categories.*',
        'ability'=>'categories.view',
    ],
    [
        'icon'=>'fas fa-box nav-icon',
        'route'=>'dashboard.products.index',
        'title'=>'Products',
        'active'=>'dashboard.products.*',
        'ability'=>'products.view',
    ],
    [
        'icon'=>'fas fa-receipt nav-icon',
        'route'=>'dashboard.orders.index',
        'title'=>'Orders',
        'active'=>'dashboard.orders.*',
        'ability'=>'order.view',
    ],
    [
        'icon'=>'fas fa-store nav-icon',
        'route'=>'dashboard.stores.index',
        'title'=>'Stores',
        'active'=>'dashboard.stores.*',
        'ability'=>'store.view',

    ],
    [
        'icon'=>'fas fa-shield nav-icon',
        'route'=>'dashboard.roles.index',
        'title'=>'Roles',
        'active'=>'dashboard.roles.*',
         'ability'=>'roles.view',
    ],
    [
        'icon'=>'fas fa-users nav-icon',
        'route'=>'dashboard.users.index',
        'title'=>'Users',
        'active'=>'dashboard.users.*',
        'ability'=>'user.view',

    ],
    [
        'icon'=>'fas fa-users nav-icon',
        'route'=>'dashboard.admins.index',
        'title'=>'Admins',
        'active'=>'dashboard.admins.*',
        'ability'=>'admin.view',

    ],



];
