<?php

return [
    'cover_image'    =>    [
        'small'    =>    [
            'width'        =>    500,
            'height'    =>    500,
        ],
        'medium'    =>    [
            'width'        =>    1000,
            'height'    =>    600,
        ],
        'large'    =>    [
            'width'        =>    1500,
            'height'    =>    550,
        ]
    ],

    /*
        | Enable or disable routes for front pages, eg:
        | http://127.0.0.1:8000/galleries | (?layout=masonry)
        | http://127.0.0.1:8000/galleries/{gallery:slug} | (?layout=masonry)
        */
    'routes' => true, // Enable or disable routes for front pages

    /**
     * Layout for front pages, possible values are: grid, masonry
     */
    'layout' => 'masonry',
];
