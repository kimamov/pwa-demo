<?php

declare(strict_types=1);

namespace Skygate\Sitepackage\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Http\JsonResponse;
use TYPO3\CMS\Core\Http\ServerRequest;
use TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication;

class UserApiController
{
    public function getAction(ServerRequest $request): ResponseInterface
    {
        /** @var FrontendUserAuthentication $feUser */
        $feUser = $request->getAttribute('frontend.user');
        
        if (!$feUser instanceof FrontendUserAuthentication || !$feUser->user) {
            return new JsonResponse([
                'isLoggedIn' => false,
            ]);
        }

        return new JsonResponse([
            'isLoggedIn' => true,
            'user' => [
                'uid' => $feUser->user['uid'],
                'username' => $feUser->user['username'],
                'email' => $feUser->user['email'],
                'name' => $feUser->user['name'],
            ],
        ]);
    }
} 