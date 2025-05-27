<?php

declare(strict_types=1);

return [
    'ctrl' => [
        'title' => 'Comment',
        'label' => 'text',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'sortby' => 'sorting',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
    ],

    'types' => [
        '0' => [
            'showitem' => 'text, author',
        ],
    ],

    'columns' => [
        'text' => [
            'exclude' => true,
            'label' => 'Text',
            'config' => [
                'type' => 'text',
            ],
        ],
        'author' => [
            'exclude' => true,
            'label' => 'Author',
            'config' => [
                'type' => 'text',
            ],
        ],
    ],
];
