<?php



namespace App\Main;



class sideMenu

{

    /**

     * List of side menu items.

     */

    public static function menu(): array
    {

        return [

            'dashboard' => [

                'icon' => 'home',

                'title' => 'Dashboard',

                'route_name' => 'dashboard-overview-1',

                'params' => [

                    'layout' => 'side-menu',

                ],
                

            ],

            // 'menu-layout' => [
            //     'icon' => 'box',
            //     'title' => 'Menu Layout',
            //     'sub_menu' => [
            //         'side-menu' => [
            //             'icon' => 'activity',
            //             'route_name' => 'dashboard-overview-1',
            //             'params' => [
            //                 'layout' => 'side-menu'
            //             ],
            //             'title' => 'Side Menu'
            //         ],
            //         'side-menu' => [
            //             'icon' => 'activity',
            //             'route_name' => 'dashboard-overview-1',
            //             'params' => [
            //                 'layout' => 'side-menu'
            //             ],
            //             'title' => 'side Menu'
            //         ]
            //     ]
            // ],
            


            'JOB' => [

                'icon' => 'Folder',

                'title' => 'JOB',

                'sub_menu' => [

                    'Complaint' => [

                        'icon' => 'Clipboard',

                        'route_name' => 'list.complaint',

                        'params' => [

                            'layout' => 'side-menu'

                        ],

                        'title' => 'Complaint',
                        'target' => ''

                    ],

                    'add-job' => [

                        'icon' => 'FileText',

                        'route_name' => 'list.job',

                        'params' => [

                            'layout' => 'side-menu'

                        ],

                        'title' => 'Job List',
                        'target' => ''

                    ],

                    'add-amc' => [

                        'icon' => 'Calendar',

                        'route_name' => 'view.calendar',

                        'params' => [

                            'layout' => 'side-menu'

                        ],

                        'title' => 'Calendar',

                        'target' => ''

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

                            'layout' => 'side-menu'

                        ],

                        'title' => 'AMC',
                        'target' => ''

                    ],

                    'upcuming-amc' => [

                        'icon' => 'Copy',

                        'route_name' => 'upcuming-amc',

                        'params' => [

                            'layout' => 'side-menu'

                        ],

                        'title' => 'Up Coming AMC',
                        'target' => ''

                    ],

                    'panding-amc' => [

                        'icon' => 'PauseCircle',

                        'route_name' => 'panding-amc',

                        'params' => [

                            'layout' => 'side-menu'

                        ],

                        'title' => 'Pending AMC',
                        'target' => ''

                    ],
                    
                     'end-amc' => [

                        'icon' => 'copy',

                        'route_name' => 'end-amc',

                        'params' => [

                            'layout' => 'side-menu'

                        ],

                        'title' => 'Up Coming End AMC',
                        'target' => ''

                    ],



                    'expire-amc' => [

                        'icon' => 'x-circle',

                        'route_name' => 'expire-amc',

                        'params' => [

                            'layout' => 'side-menu'

                        ],

                        'title' => 'Expire AMC',
                        'target' => ''

                    ],

                   

                ]

            ],


        
            'service' => [

                'icon' => 'users',

                'title' => 'service',

                'sub_menu' => [



                    'category' => [

                        'icon' => 'Layers',

                        'route_name' => 'category',

                        'params' => [

                            'layout' => 'side-menu'

                        ],

                        'title' => 'Category',
                        'target' => ''

                    ],

                    'subcategory' => [

                        'icon' => 'Layers',

                        'route_name' => 'subcategory',

                        'params' => [

                            'layout' => 'side-menu'

                        ],

                        'title' => 'subcategory',
                        'target' => ''

                    ],
                ]

            ],

            

            'users' => [

                'icon' => 'users',

                'title' => 'Users',

                'sub_menu' => [



                    // 'users' => [

                    //     'icon' => 'User',

                    //     'route_name' => 'users',

                    //     'params' => [

                    //         'layout' => 'side-menu'

                    //     ],

                    //     'title' => 'Users',
                    //     'target' => ''

                    // ],

                    'technician' => [

                        'icon' => 'Users',

                        'route_name' => 'technician',

                        'params' => [

                            'layout' => 'side-menu'

                        ],

                        'title' => 'Technician',
                        'target' => ''

                    ], 
                    'helper' => [

                        'icon' => 'Users',

                        'route_name' => 'helper',

                        'params' => [

                            'layout' => 'side-menu'

                        ],
                        'title' => 'Helper',
                        'target' => ''

                    ],

                    'supervisor' => [

                        'icon' => 'Users',

                        'route_name' => 'supervisor.index',

                        'params' => [

                            'layout' => 'side-menu'

                        ],
                        'title' => 'Supervisor',
                        'target' => ''

                    ],

                ]

            ],

            'Customer' => [

                'icon' => 'User',

                'title' => 'Customer',

                'route_name' => 'customer.list',

                'params' => [



                ],

            ],

            'Product' => [

                'icon' => 'Box',

                'title' => 'Product',

                'route_name' => 'view.product',

                'params' => [



                ],

            ],



            // 'Invoice' => [

            //     'icon' => 'Aperture',

            //     'title' => 'Invoice',

            //     'route_name' => 'create.invoice',

            //     'params' => [



            //     ],

            //     'sub_menu'=>[

            //         'genrate_invoice' => [

            //             'icon' => 'Codesandbox',

            //             'route_name' => 'create.invoice',

            //             'params' => [

            //                 'layout' => 'side-menu'

            //             ],

            //             'title' => 'Create Invoice',
            //             'target' => ''

            //         ],

            //         'view_invoice' => [

            //             'icon' => 'Codesandbox',

            //             'route_name' => 'list.invoice',

            //             'params' => [

            //                 'layout' => 'side-menu'

            //             ],

            //             'title' => 'View Invoice',
            //             'target' => ''

            //         ],

            //     ]

            // ],
            //  'Invoice' => [

            //     'icon' => 'Aperture',

            //     'title' => 'Invoice',

            //     'route_name' => 'create.invoice',

            //     'params' => [



            //     ],

            //     'sub_menu'=>[

            //         'genrate_invoice' => [

            //             'icon' => 'Codesandbox',

            //             'route_name' => 'create.invoice',

            //             'params' => [

            //                 'layout' => 'side-menu'

            //             ],

            //             'title' => 'Create Invoice',
            //             'target' => ''

            //         ],

            //         'view_invoice' => [

            //             'icon' => 'Codesandbox',

            //             'route_name' => 'list.invoice',

            //             'params' => [

            //                 'layout' => 'side-menu'

            //             ],

            //             'title' => 'View Invoice',
            //             'target' => ''

            //         ],

            //     ]

            // ],

            'Report ' => [

                'icon' => 'Aperture',

                'title' => 'Report ',

                'sub_menu' => [

                    'Complaint Report' => [

                        'icon' => 'BarChart2',

                        'route_name' => 'complainreport',

                        'params' => [

                            'layout' => 'side-menu'

                        ],

                        'title' => 'Complaint Report',
                        'target' => ''

                    ],

                    'Technician Report' => [

                        'icon' => 'Users',

                        'route_name' => 'technicianreport',

                        'params' => [

                            'layout' => 'side-menu'

                        ],

                        'title' => 'Technician Report',
                        'target' => ''

                    ],

                    'AMC Report' => [

                        'icon' => 'PauseCircle',

                        'route_name' => 'amcreport',

                        'params' => [

                            'layout' => 'side-menu'

                        ],

                        'title' => 'AMC Report',
                        'target' => ''

                    ],

                    'Customer Report' => [

                        'icon' => 'User',

                        'route_name' => 'customerreport',

                        'params' => [

                            'layout' => 'side-menu'

                        ],

                        'title' => 'Customer Report',
                        'target' => ''

                    ],



                ]

            ],



        ];

    }

}