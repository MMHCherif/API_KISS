<?php
namespace App\Controller\API;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use App\Entity\Product;
use FOS\RestBundle\View\View ;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use JMS\Serializer;
use App\Repository\ProductRepository;
class ProductController extends FOSRestController 
{
	 /**
     * Creates an Product resource
     * @Rest\Post("/product")
     * 
     * @param Request $request
     * @return View
     */
    public function postProduct(Request $request): View
    {
       	$product = new Product();
        $product->setActive($request->get('active'));
        $product->setName($request->get('name'));
        $product->setUrl($request->get('url'));
        $product->setDescription($request->get('description'));
        $product->setId(md5($request->get('id')));
        $em = $this->getDoctrine()->getManager();
        $em	->add($product);
           	->flush();
        $this->serialize($product,'JSON')  ; 
        return View::create($product, Response::HTTP_OK);
    }
     /**
     * Retrieves an Product resource
     * @Rest\Get("/product/{id}")
     */
   
    public function getProduct($id): View
    {
        $product = $this->getDoctrine()
        				->getRepository(Product::class)
        				->find($id)
        				;
        $this->serialize($product,'JSON')  ; 
        return View::create($product, Response::HTTP_OK);
    }
    /**
     * Delete an Product resource
     * @Rest\Delete("/product/{id}")
     * @param IdProduct
     * @return View
     */
    public function DeleteProduct($id): View
    {
    	if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) 
    	{
            $em = $this->getDoctrine()->getManager();
            $em->remove($product);
            $em->flush();
    	}
    	$res=serialize($product);
    	return View::create($res, Response::HTTP_OK);
    }
    /**
     * Delete an Product resource
     * @Rest\Put("/product/{id}")
     * @param Request $request
     * @return View
     */
    public function PutProduct(request $request): View
    {
    	$product=$this->deserialize($request->getData());
    		
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();
    	
    	$res=serialize($product);
    	return View::create($res, Response::HTTP_OK);
    }

}