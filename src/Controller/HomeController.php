<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function index(\App\Repository\ProductRepository $productRepository, \App\Repository\CategoryRepository $categoryRepository): Response
    {
        $totalProducts = $productRepository->countAll();
        $totalCategories = count($categoryRepository->findAll());
        $latestProducts = $productRepository->findLatest(3);
        $categories = $categoryRepository->findAll();

        return $this->render('home/index.html.twig', [
            'totalProducts' => $totalProducts,
            'totalCategories' => $totalCategories,
            'latestProducts' => $latestProducts,
            'categories' => $categories,
        ]);
    }
}