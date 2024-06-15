<?php



namespace App\Main;



class TopMenu

{

    /**

     * List of top menu items.

     */

    public static function menu(): array
    {

        return [

            'dashboard' => [

                'icon' => 'home',

                'title' => 'Dashboard',

                'route_name' => 'dashboard-overview-1',

                'params' => [

                    'layout' => 'top-menu',

                ],

            ],

            'menu-layout' => [
                'icon' => 'box',
                'title' => 'Menu Layout',
                'sub_menu' => [
                    'side-menu' => [
                        'icon' => 'activity',
                        'route_name' => 'dashboard-overview-1',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Side Menu'
                    ],
                    'top-menu' => [
                        'icon' => 'activity',
                        'route_name' => 'dashboard-overview-1',
                        'params' => [
                            'layout' => 'top-menu'
                        ],
                        'title' => 'Top Menu1'
                    ]
                ]
            ],
            


            'JOB' => [

                'icon' => 'Aperture',

                'title' => 'JOB',

                'sub_menu' => [

                    'Complaint' => [

                        'icon' => 'Codesandbox',

                        'route_name' => 'list.complaint',

                        'params' => [

                            'layout' => 'top-menu'

                        ],

                        'title' => 'Complaint'

                    ],

                    'add-job' => [

                        'icon' => 'Codesandbox',

                        'route_name' => 'list.job',

                        'params' => [

                            'layout' => 'top-menu'

                        ],

                        'title' => 'Job List'

                    ],

                    'category' => [

                        'icon' => 'Codesandbox',

                        'route_name' => 'category',

                        'params' => [

                            'layout' => 'top-menu'

                        ],

                        'title' => 'Category'

                    ],

                    

                    'add-amc' => [

                        'icon' => 'Codesandbox',

                        'route_name' => 'view.calendar',

                        'params' => [

                            'layout' => 'top-menu'

                        ],

                        'title' => 'Calendar'

                    ]



                ]

            ],



            'AMC' => [

                'icon' => 'Aperture',

                'title' => 'AMC',

                'sub_menu' => [

                    'add-amc' => [

                        'icon' => 'Codesandbox',

                        'route_name' => 'list.amc',

                        'params' => [

                            'layout' => 'top-menu'

                        ],

                        'title' => 'AMC'

                    ],

                    'upcuming-amc' => [

                        'icon' => 'Copy',

                        'route_name' => 'upcuming-amc',

                        'params' => [

                            'layout' => 'top-menu'

                        ],

                        'title' => 'Up Cuming AMC'

                    ],

                    'panding-amc' => [

                        'icon' => 'PauseCircle',

                        'route_name' => 'panding-amc',

                        'params' => [

                            'layout' => 'top-menu'

                        ],

                        'title' => 'Panding AMC'

                    ],

                    'expire-amc' => [

                        'icon' => 'x-circle',

                        'route_name' => 'expire-amc',

                        'params' => [

                            'layout' => 'top-menu'

                        ],

                        'title' => 'Expire AMC'

                    ],



                ]

            ],



            

            'users' => [

                'icon' => 'users',

                'title' => 'Users',

                'sub_menu' => [



                    'users' => [

                        'icon' => 'User',

                        'route_name' => 'users',

                        'params' => [

                            'layout' => 'top-menu'

                        ],

                        'title' => 'Users'

                    ],

                    'technician' => [

                        'icon' => 'Users',

                        'route_name' => 'technician',

                        'params' => [

                            'layout' => 'top-menu'

                        ],

                        'title' => 'Technician'

                    ], 
                    'helper' => [

                        'icon' => 'Users',

                        'route_name' => 'helper',

                        'params' => [

                            'layout' => 'top-menu'

                        ],
                        'title' => 'Helper'

                    ],

                ]

            ],

            'Customer' => [

                'icon' => 'Aperture',

                'title' => 'Customer',

                'route_name' => 'customer.list',

                'params' => [



                ],

            ],

            'Product' => [

                'icon' => 'Aperture',

                'title' => 'Product',

                'route_name' => 'view.product',

                'params' => [



                ],

            ],



            'Invoice' => [

                'icon' => 'Aperture',

                'title' => 'Invoice',

                'route_name' => 'create.invoice',

                'params' => [



                ],

                'sub_menu'=>[

                    'genrate_invoice' => [

                        'icon' => 'Codesandbox',

                        'route_name' => 'create.invoice',

                        'params' => [

                            'layout' => 'top-menu'

                        ],

                        'title' => 'Create Invoice'

                    ],

                    'view_invoice' => [

                        'icon' => 'Codesandbox',

                        'route_name' => 'list.invoice',

                        'params' => [

                            'layout' => 'top-menu'

                        ],

                        'title' => 'View Invoice'

                    ],

                ]

            ],
             'Invoice' => [

                'icon' => 'Aperture',

                'title' => 'Invoice',

                'route_name' => 'create.invoice',

                'params' => [



                ],

                'sub_menu'=>[

                    'genrate_invoice' => [

                        'icon' => 'Codesandbox',

                        'route_name' => 'create.invoice',

                        'params' => [

                            'layout' => 'top-menu'

                        ],

                        'title' => 'Create Invoice'

                    ],

                    'view_invoice' => [

                        'icon' => 'Codesandbox',

                        'route_name' => 'list.invoice',

                        'params' => [

                            'layout' => 'top-menu'

                        ],

                        'title' => 'View Invoice'

                    ],

                ]

            ],

            'Report ' => [

                'icon' => 'Aperture',

                'title' => 'Report ',

                'sub_menu' => [

                    'Complaint Report' => [

                        'icon' => 'BarChart2',

                        'route_name' => 'complainreport',

                        'params' => [

                            'layout' => 'top-menu'

                        ],

                        'title' => 'Complaint Report'

                    ],

                    'Technician Report' => [

                        'icon' => 'Users',

                        'route_name' => 'technicianreport',

                        'params' => [

                            'layout' => 'top-menu'

                        ],

                        'title' => 'Technician Report'

                    ],

                    'AMC Report' => [

                        'icon' => 'PauseCircle',

                        'route_name' => 'amcreport',

                        'params' => [

                            'layout' => 'top-menu'

                        ],

                        'title' => 'AMC Report'

                    ],



                ]

            ],



        ];

    }

}