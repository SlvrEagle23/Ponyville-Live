<?php
return array(

    'default_module' => 'frontend', // Use "frontend", because "default" causes namespacing problems.
    'default_controller' => 'index',
    'default_action' => 'index',

    'custom_routes' => array(
        // Homepage.
        '/' => array(
            'module' => 'frontend',
            'controller' => 'index',
            'action' => 'index',
            'name' => 'home',
        ),

        // Info pages.
        '/about' => array(
            'module' => 'frontend',
            'controller' => 'index',
            'action' => 'about',
        ),
        '/apps' => array(
            'module' => 'frontend',
            'controller' => 'index',
            'action' => 'app',
        ),
        '/donate' => array(
            'module' => 'frontend',
            'controller' => 'index',
            'action' => 'donate',
        ),
        '/mobile' => array(
            'module' => 'frontend',
            'controller' => 'index',
            'action' => 'mobile',
        ),
        '/conventions' => array(
            'module' => 'frontend',
            'controller' => 'convention',
            'action' => 'index',
        ),
        '/contact' => array(
            'module' => 'frontend',
            'controller' => 'index',
            'action' => 'contact',
        ),

        // Podcasts
        '/shows' => array(
            'module' => 'frontend',
            'controller' => 'show',
            'action' => 'index',
            'name' => 'show-listing',
        ),

        // Old URLs.
        '/stations/submit' => array(
            'module' => 'frontend',
            'controller' => 'submit',
            'action' => 'station',
        ),
        '/events' => array(
            'module' => 'frontend',
            'controller' => 'convention',
            'action' => 'index',
        ),
        '/events/schedule' => array(
            'module' => 'frontend',
            'controller' => 'schedule',
            'action' => 'index',
        ),
    ),

);