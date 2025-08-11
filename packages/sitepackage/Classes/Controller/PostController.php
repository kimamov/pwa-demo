<?php
declare(strict_types=1);

namespace Skygate\Sitepackage\Controller;

use Psr\Http\Message\ResponseInterface;
use Skygate\Sitepackage\Domain\Repository\PostRepository;
use TYPO3\CMS\Core\Resource\FileReference as CoreFileReference;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class PostController extends ActionController
{
    public function __construct(private readonly PostRepository $postRepository)
    {
    }

    public function listAction(): ResponseInterface
    {
        $posts = $this->postRepository->findAll();

        $data = [];
        foreach ($posts as $post) {
            $imageUrl = null;
            $image = $post->getImage();
            if ($image !== null) {
                $original = $image->getOriginalResource();
                if ($original instanceof CoreFileReference) {
                    $file = $original->getOriginalFile();
                    $imageUrl = $file->getPublicUrl();
                } else {
                    $imageUrl = $original->getPublicUrl();
                }
            }

            $data[] = [
                'uid' => $post->getUid(),
                'title' => $post->getTitle(),
                'content' => $post->getContent(),
                'image' => $imageUrl,
            ];
        }

        return $this->jsonResponse((string)json_encode(['posts' => $data, 'settings' => $this->settings]));
    }
}
