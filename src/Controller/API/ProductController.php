<?php
namespace App\Controller\API;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use App\Entity\Product;
use FOS\RestBundle\View\View ;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer;
use App\Repository\ProductRepository;
use FOS\RestBundle\Controller\Annotations\Post;
use App\Entity\Brand;
use App\Entity\Category;
class ProductController extends FOSRestController 
{
	 /**
     * Creates an Product resource
     * @Rest\Post("/product/")
     * 
     */
   	public function postProduct(Request $request): View
    {
       	$product= new Product();
       // $id=$request->get('id');
       // $product->setId($id);
        $product=json_decode(file_get_contents($request->files->get('test')));
       // $name=$request->get('content');
        var_dump($product);die();
        $product->setName('test');
        $brand=new Brand();
        $brand=$request->get('brand');
        $product->setBrand($brand);
        $category=new Category();
        $category=$request->get('category');
        $product->setCategory($category);
        //$product->setValide($request->get('valide'));
        $description=$request->get('description');
        $product->setDescription($description);
        $em = $this->getDoctrine()->getManager();
        $em	->persist($product);
        $em->flush();
        
        if (empty($request->get('id')))
        	return  View::create("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE); 
        return View::create('ok', Response::HTTP_OK);
    }
     /**
     * Retrieves an Product resource
     * @Rest\Get("/product/{id}")
     */
   
    public function getProduct($id): View
    {
        $product = $this->getDoctrine()
        				->getRepository(Product::class)
        				->findById($id)
        				;
       
        return View::create($product, Response::HTTP_OK);
    }
    /*/**
     * Delete an Product resource
     * @Rest\Delete("/product/{id}")
     * @param IdProduct
     * @return View
     */
    /*public function DeleteProduct($id): View
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
    /*public function PutProduct(request $request): View
    {
    	$product=$this->deserialize($request->getData());
    		
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();
    	
    	$res=serialize($product);
    	return View::create($res, Response::HTTP_OK);
    }
*/
}