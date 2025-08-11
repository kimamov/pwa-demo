<?php
declare(strict_types=1);

namespace Skygate\Sitepackage\Controller;

use Psr\Http\Message\ResponseInterface;
use Skygate\Sitepackage\Domain\Repository\StudentRepository;
use TYPO3\CMS\Core\Resource\FileReference as CoreFileReference;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class StudentController extends ActionController
{
    public function __construct(private readonly StudentRepository $studentRepository)
    {
    }

    public function listAction(): ResponseInterface
    {
        $students = $this->studentRepository->findAll();

        $data = [];
        foreach ($students as $student) {
            $imageUrl = null;
            $image = $student->getImage();
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
                'uid' => $student->getUid(),
                'name' => $student->getName(),
                'lastname' => $student->getLastname(),
                'image' => $imageUrl,
            ];
        }

        return $this->jsonResponse((string)json_encode(['students' => $data, 'settings' => $this->settings]));
    }
}


