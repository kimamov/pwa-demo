
<?php

declare(strict_types=1);

use Skygate\Sitepackage\Controller\UserApiController;
use TYPO3\CMS\Core\Routing\RouteCollection;



return static function (RouteCollection $routeCollection): void {
    // Example API route: /api/v1/my-data
    // This route maps to the 'getData' action in 'MyDataController'
    // within your extension's 'Api' namespace.
    $routeCollection->add(
        // A unique identifier for the route
        'api_sitepackage_user',
        // The route definition
        (new \TYPO3\CMS\Core\Routing\Route(
            // The path of your API endpoint
            '/api/user/get',
            // Default values, specifying the controller and action
            [
            '_controller' => UserApiController::class . '::getAction',
            '_public' => true,

            ],
            // Requirements for route parameters (optional)
            [],
            // Options for the route (e.g., methods allowed)
            ['methods' => ['GET']]
        ))
    );

    // You can add more routes here
    /*
    $routeCollection->add(
        'api_myextension_postdata',
        (new \TYPO3\CMS\Core\Routing\Route(
            '/api/v1/submit-data',
            [
                '_controller' => \MyVendor\MyExtension\Controller\Api\MyDataController::class . '::postDataAction',
            ],
            [],
            ['methods' => ['POST']]
        ))
    );
    */
};