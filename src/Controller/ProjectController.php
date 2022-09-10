<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class ProjectController extends AbstractController
{


    public function __construct(
        private ProjectRepository $projectRepository
    )
    {
    }

    #[Route('/', name: 'list_project')]
    public function index(Request $request): Response
    {

        $form = $this->createFormBuilder(null)
            ->add('query', TextType::class)
            ->add('search', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['query'];



            return $this->render('project/index.html.twig', [
                'projects' => $this->projectRepository->findByNameLike($search),
                'form' => $form->createView(),
            ]);
        }

        return $this->render('project/index.html.twig', [
            'projects' => $this->projectRepository->findAll(),
            'form' => $form->createView(),
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
