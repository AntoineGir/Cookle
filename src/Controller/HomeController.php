<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(RecipeRepository $recipeRepository): Response
    {
        $allRecipe = $recipeRepository->findAll();
        $uneRecette = array_rand($allRecipe,1);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'randomrecipe' => $allRecipe[$uneRecette],
            'recipe' => $allRecipe,
        ]);
    }
}
