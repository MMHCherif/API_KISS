<?php
namespace App\Controller\API;
use FOS\RestBundle\Controller\Annotations as Rest;
use OS\RestBundle\Controller\FOSRestController;
use App\Entity\Product;
class ProductsController extends FOSRestController
{
	 /**
     * Creates an Product resource
     * @Rest\Post("/product")
     * @param Request $request
     * @return View
     */
    public function postArticle(Request $request): View
    {
       /* $product = new Product();
        $product->set($request->get('active'));
        $article->setContent($request->get('content'));
        $this->articleRepository->save($article);
        // In case our POST was a success we need to return a 201 HTTP CREATED response
        return View::create($article, Response::HTTP_CREATED);*/
    }
}