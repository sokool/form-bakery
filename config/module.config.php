<?php

return [
    'form_bakery' => [
        'annotation_builder' => 'Zend\Form\Annotation\AnnotationBuilder',
        'cache'              => [
//            'adapter' => [
//                'name'    => 'memcached',
//                'options' => [
//                    'servers' => [
//                        ['127.0.0.1', '11211']
//                    ]
//                ],
//            ],
//            'adapter' => [
//                'name'    => 'filesystem',
//                'options' => [
//                    'cache_dir' => 'data/mint-soft/form-bakery'
//                ],
//            ],
            'adapter' => [
                'name' => 'memory',
            ],

        ]
    ]
];