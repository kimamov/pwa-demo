<?php

declare(strict_types=1);

namespace Skygate\Sitepackage\Controller;

use Psr\Http\Message\ResponseInterface;
use Skygate\Sitepackage\Domain\Model\Comment;
use Skygate\Sitepackage\Domain\Repository\CommentRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class CommentController extends ActionController
{
    public function __construct(
        protected readonly CommentRepository $commentRepository,
    ) {
    }

    public function listAction(): ResponseInterface
    {
        if ($this->request->getMethod() === 'POST') {
            $body = $this->request->getParsedBody();

            return $this->redirect(
                actionName: 'add',
                arguments: ['text' => $body['text'], 'author' => $body['author']],
            );
        }

        $comments = $this->commentRepository->findAll()->toArray();

        return $this->jsonResponse(
            json_encode([
                'comments' => $comments,
            ]),
        );
    }

    public function addAction(): ResponseInterface
    {
        $arguments = $this->request->getArguments();

        $comment = new Comment(
            text: $arguments['text'],
            author: $arguments['author'],
        );

        $this->commentRepository->add($comment);

        return $this->jsonResponse(
            json_encode([
                'success' => true,
            ]),
        );
    }
}
