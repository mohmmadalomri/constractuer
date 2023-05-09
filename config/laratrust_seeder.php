<?php

return [

    'create_users' => false,

    /* Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'superadministrator' => [
            'users' => 'c,r,u,d',
            'payments' => 'c,r,u,d',
            'profile' => 'r,u',
            'employees' => 'c,r,u,d',
            'expenses' => 'c,r,u,d',
            'invoices' => 'c,r,u,d',
            'tesk' => 'c,r,u,d',
            'project' => 'c,r,u,d',
            'company' => 'c,r,u,d',
        ],
        'administrator' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
            'project' => 'c,r,u,d',
            'employees' => 'c,r,u,d',
            'expenses' => 'c,r,u,d',
            'invoices' => 'c,r,u,d',
            'tesk' => 'c,r,u,d',
            'company' => 'r,u',
        ],
        'editor'=> [
            'profile' => 'r,u',
            'Invoices' => '',
            'Price offer'=> '',
        ],
        'engineer'=>[
            'profile' => 'r,u',
            'Project' => 'r',
            'tesk' => 'r,u',
        ],
        'Account manager'=>[
            'employees' => 'c,r,u,d',
            'expenses' => 'c,r,u,d',
            'company' => 'r,u',
            'invoices' => 'c,r,u,d',
            'profile' => 'r,u',
            'tesk' => 'c,r,u,d',
            'Project' => 'c,r,u,d',
        ],
        'Accountant' => [
            'expenses'=> 'c,r,u,d',
            'invoices' => 'r,u',
            'profile' => 'r,u',
        ],
        'employee' => [
            'Project' => '',
            'Completion' => '',
        ],
        "moderators" => [
            'profile' => 'r,u',
            'tesk' => 'r',
            'Project' => 'r',
        ]
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];