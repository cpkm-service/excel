<?php

return [
    'import'    =>  [
        'model' =>  Cpkm\Excel\Models\ExcelImport::class,
        'service'   => Cpkm\Excel\Services\ImportService::class,
        'types' =>  [
        ],
        'form'  => [
            'name'  =>  'import',
            'action'=>  '',
            'back'  =>  '',
            'method'=>  "POST",
            'form'  =>  [
                [
                    'class'  =>  'row',
                    'col'   =>  [
                        [
                            'class' =>  'col-xl-8 col-md-12',
                            'col'   =>  [
                                [
                                    'class' =>  'row',
                                    'col'   =>  [
                                        [
                                            'class' =>  'col-xl-12',
                                            'col'   =>  [
                                                [
                                                    'class' =>  'fields',
                                                    'field' =>  'model'
                                                ]
                                            ]
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'class'  =>  'row',
                    'col'   =>  [
                        [
                            'class' =>  'col-xl-8 col-md-12',
                            'col'   =>  [
                                [
                                    'class' =>  'row',
                                    'col'   =>  [
                                        [
                                            'class' =>  'col-xl-6',
                                            'col'   =>  [
                                                [
                                                    'class' =>  'fields',
                                                    'field' =>  'file'
                                                ]
                                            ]
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'fields'    =>  [
                'model'   =>  [
                    'tag'           =>  'select',
                    'name'          =>  'model',
                    'text'          =>  'excel::backend.excel_imports.model',
                    'placeholder'   =>  'excel::backend.excel_imports.model',
                    'disabled'      =>  false,
                    'required'      =>  true,
                    'options'       =>  [],
                    'rules'         =>  [
                        'required'  =>  true,
                    ],
                    'api_rules'         =>  [
                        'common'    =>  [
                            'required',
                            'string',
                        ],
                    ],
                ],
                'file'   =>  [
                    'tag'           =>  'input',
                    'type'          =>  'file',
                    'name'          =>  'file',
                    'text'          =>  'excel::backend.excel_imports.file',
                    'placeholder'   =>  'excel::backend.excel_imports.file',
                    'required'  =>  true,
                    'rules'         =>  [
                        'required'  =>  true,
                    ],
                    'api_rules'         =>  [
                        'common'    =>  [
                            'required',
                            'mimes:csv',
                        ],
                    ],
                ],
            ],
        ],
    ],
];
