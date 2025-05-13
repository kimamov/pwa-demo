<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'sitepackage',
    'description' => '',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'bootstrap_package' => '15.0.0-15.99.99',
            'contentblocks/contentblocks' => "*",
            'netzbewegung/nb_headless_content_blocks' => ''
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Skygate\\Sitepackage\\' => 'Classes',
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Kantemir Imamov',
    'author_email' => 'imamov@skygate.de',
    'author_company' => 'Skygate',
    'version' => '1.0.0',
];
