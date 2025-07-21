<?php

declare(strict_types=1);

namespace Skygate\Sitepackage\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication;

class UserApiController extends ActionController
{
    public function getAction(): ResponseInterface
    {
        /** @var FrontendUserAuthentication $feUser */
        $feUser = $this->request->getAttribute('frontend.user');
        
        if (!$feUser instanceof FrontendUserAuthentication || !$feUser->user) {
            return $this->jsonResponse(
                json_encode([
                    'isLoggedIn' => false,
                ])
            );
        }

        return $this->jsonResponse(
            json_encode([
                'isLoggedIn' => true,
                'user' => [
                    'uid' => $feUser->user['uid'],
                    'username' => $feUser->user['username'],
                    'email' => $feUser->user['email'],
                    'name' => $feUser->user['name'],
                ],
            ])
        );
    }
} 