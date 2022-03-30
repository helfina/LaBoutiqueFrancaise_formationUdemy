<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/nos-produits", name="products")
     */
    public function index(EntityManagerInterface $manager): Response
    {
        $products = $manager->getRepository(Product::class)->findAll();

        //dump($products);
        return $this->render('product/index.html.twig',[
            'products' => $products,
            ]);
    }

    /**
     * @Route("/produit/{slug}", name="product")
     */
    public function show(EntityManagerInterface $manager, $slug = ''){

        $product = $manager->getRepository(Product::class)->findOneBy(['slug'=>$slug]);

        if (!$product){
            return $this->redirectToRoute('products');
        }
        dump($product);
        return $this->render('product/show.html.twig',[
            'products' => $product,
        ]);
    }
}
