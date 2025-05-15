<?php

declare(strict_types=1);

namespace Skygate\Sitepackage\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class ExampleController extends ActionController
{
    public function indexAction(): ResponseInterface
    {
        return $this->jsonResponse(
            json_encode([
                'test' => 'Example Test',
                'test2' => 'Hallo',
                'files' => $this->request->getUploadedFiles(),
            ]),
        );
    }
}
