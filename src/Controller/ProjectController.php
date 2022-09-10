<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{


    public function __construct(
        private ProjectRepository $projectRepository
    )
    {
    }

    #[Route('/', name: 'list_project')]
    public function index(): Response
    {

        return $this->render('project/index.html.twig', [
            'projects' => $this->projectRepository->findAll(),
        ]);
    }

    #[Route('/project/{id}', name: 'project_show')]
    public function show(int $id): Response
    {
        return $this->render('project/show.html.twig', [
            'project' => $this->projectRepository->find($id),
        ]);
    }
}
