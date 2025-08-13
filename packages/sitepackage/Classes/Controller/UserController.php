<?php
declare(strict_types=1);

namespace Skygate\Sitepackage\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
// use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
// use Psr\Http\Message\ServerRequestInterface;
// use TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication;
use TYPO3\CMS\Core\Context\Context;


class UserController extends ActionController
{

  public function __construct(
        private readonly Context $context,
    ) {}

    public function getAction(): ResponseInterface
    {


        // /** @var FrontendUserAuthentication $frontendUserAuthentification */
        // $frontendUserAuthentification = $request->getAttribute('frontend.user');
        // $frontendUserAuthentification->fetchGroupData($request);

        $userIsLoggedIn = $this->context->getPropertyFromAspect(
            'frontend.user',
            'isLoggedIn',
        );
        if(!$userIsLoggedIn) {
            return $this->jsonResponse((string)json_encode(['user' => null, 'isLoggedIn' => false]));
        }

        $userName = $this->context->getPropertyFromAspect(
            'frontend.user',
            'username',
        );
        $userId = $this->context->getPropertyFromAspect(
            'frontend.user',
            'id',
        );

        return $this->jsonResponse((string)json_encode(['user' => [
            'uid' => $userId,
            'username' => $userName,
        ], 'isLoggedIn' => $userIsLoggedIn]));
        // // do something
        // /** @var \TYPO3\CMS\Core\Context\Context $context */
        // $context = $GLOBALS['TYPO3_REQUEST']->getAttribute('context');
        // $isLoggedIn = $context->getPropertyFromAspect('frontend.user', 'isLoggedIn');
        // $userData = null;

        // if ($isLoggedIn) {
        //     $user = $context->getAspect('frontend.user')->get('user');
        //     $userData = [
        //         'uid' => (int)($user['uid'] ?? 0),
        //         'username' => $user['username'] ?? '',
        //         'email' => $user['email'] ?? '',
        //         'name' => $user['name'] ?? '',
        //     ];
        // }


        // return $this->jsonResponse((string)json_encode(['user' => $userData, 'isLoggedIn' => $isLoggedIn]));
    }
}
