<?php
return [
    'BE' => [
        'debug' => true,
        'installToolPassword' => '$2a$12$eCPenIJ4AUYrkXke5DpuVuNX5gKxGSzBu2ExOdYrDwTXtOT2kUiK.',
        'passwordHashing' => [
            'className' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\Argon2iPasswordHash',
            'options' => [],
        ],
    ],
    'DB' => [
        'Connections' => [
            'Default' => [
                'charset' => 'utf8',
                'driver' => 'mysqli',
            ],
        ],
    ],
    'EXT' => [],
    'EXTENSIONS' => [
        'backend' => [
            'backendFavicon' => '',
            'backendLogo' => '',
            'loginBackgroundImage' => '',
            'loginFootnote' => '',
            'loginHighlightColor' => '',
            'loginLogo' => '',
            'loginLogoAlt' => '',
        ],
        'bootstrap_package' => [
            'disableCssProcessing' => '0',
            'disableGoogleFontCaching' => '0',
            'disablePageTsBackendLayouts' => '0',
            'disablePageTsContentElements' => '0',
            'disablePageTsRTE' => '0',
            'disablePageTsTCADefaults' => '0',
            'disablePageTsTCEFORM' => '0',
            'disablePageTsTCEMAIN' => '0',
        ],
        'extensionmanager' => [
            'automaticInstallation' => '1',
            'offlineMode' => '0',
        ],
        'mask' => [
            'backend' => 'EXT:sitepackage/Resources/Private/Mask/Backend/Templates',
            'backend_layouts_folder' => '',
            'backendlayout_pids' => '0',
            'content' => 'EXT:sitepackage/Resources/Private/Mask/Frontend/Templates',
            'content_elements_folder' => '',
            'json' => 'EXT:sitepackage/Configuration/Mask/mask.json',
            'layouts' => 'EXT:sitepackage/Resources/Private/Mask/Frontend/Layouts',
            'layouts_backend' => 'EXT:sitepackage/Resources/Private/Mask/Backend/Layouts',
            'loader_identifier' => 'json',
            'override_shared_fields' => '0',
            'partials' => 'EXT:sitepackage/Resources/Private/Mask/Frontend/Partials',
            'partials_backend' => 'EXT:sitepackage/Resources/Private/Mask/Backend/Partials',
            'preview' => 'EXT:sitepackage/Resources/Public/Mask/',
        ],
        'redirects' => [
            'showCheckIntegrityInfoInReports' => '1',
            'showCheckIntegrityInfoInReportsSeconds' => '86400',
        ],
    ],
    'FE' => [
        'debug' => true,
        'passwordHashing' => [
            'className' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\Argon2iPasswordHash',
            'options' => [
                'hash',
            ],
        ],
    ],
    'GFX' => [
        'processor' => 'ImageMagick',
        'processor_effects' => true,
        'processor_enabled' => true,
        'processor_path' => '/usr/bin/',
    ],
    'LOG' => [
        'TYPO3' => [
            'CMS' => [
                'deprecations' => [
                    'writerConfiguration' => [
                        'notice' => [
                            'TYPO3\CMS\Core\Log\Writer\FileWriter' => [
                                'disabled' => false,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'MAIL' => [
        'transport' => 'sendmail',
        'transport_sendmail_command' => '/usr/local/bin/mailhog sendmail test@example.org --smtp-addr 127.0.0.1:1025',
        'transport_smtp_encrypt' => '',
        'transport_smtp_password' => '',
        'transport_smtp_server' => '',
        'transport_smtp_username' => '',
    ],
    'SYS' => [
        'caching' => [
            'cacheConfigurations' => [
                'hash' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                ],
                'imagesizes' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                    'options' => [
                        'compression' => true,
                    ],
                ],
                'pages' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                    'options' => [
                        'compression' => true,
                    ],
                ],
                'rootline' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                    'options' => [
                        'compression' => true,
                    ],
                ],
            ],
        ],
        'cookieDomain' => 'pwa-demo.ddev.site',
        'devIPmask' => '*',
        'displayErrors' => 1,
        'encryptionKey' => '517d47fd2681627245de9c4a4a726ac2e833c8bca7c5c0ad543c12e9f2ddbd8803a83044b6a4f247b26ceddf03be451d',
        'exceptionalErrors' => 12290,
        'features' => [
            'headless.elementBodyResponse' => true,
            'headless.redirectMiddlewares' => true,
            'headless.storageProxy' => true,
            'unifiedPageTranslationHandling' => true,
        ],
        'sitename' => 'PWA Demo',
        'systemMaintainers' => [
            2,
        ],
        'trustedHostsPattern' => '.*.*',
    ],
];
