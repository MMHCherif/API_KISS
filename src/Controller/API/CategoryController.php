<?php
namespace App\Controller\API;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use App\Entity\Category;
use FOS\RestBundle\View\View ;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use JMS\Serializer;
use App\Repository\ProductRepository;
class CategoryController extends FOSRestController 
{
	 /**
     * Creates an Product resource
     * @Rest\Post("/category")
     * 
     * @param Request $request
     * @return View
     */
    public function postProduct(Request $request): View
    {
       	$Category = new Category();
        $Category->setName($request->get('name'));
        $Category->setId(md5($request->get('id')));
        $em = $this->getDoctrine()->getManager();
        $em	->add($Category);
           	$em->flush();
        $this->serialize($Category,'JSON')  ; 
        return View::create($Category, Response::HTTP_OK);
    }
     /**
     * Retrieves an Category resource
     * @Rest\Get("/Category/{id}")
     */
   
    public function getCategory($id): View
    {
        $Category = $this->getDoctrine()
        				->getRepository(Category::class)
        				->find($id)
        				;
        $this->serialize($Category,'JSON')  ; 
        return View::create($Category, Response::HTTP_OK);
    }
    /**
     * Delete an Category resource
     * @Rest\Delete("/Category/{id}")
     * @param IdCategory
     * @return View
     */
    public function DeleteCategory($id): View
    {
    	if ($this->isCsrfTokenValid('delete'.$Category->getId(), $request->request->get('_token'))) 
    	{
            $em = $this->getDoctrine()->getManager();
            $em->remove($Category);
            $em->flush();
    	}
    	$res=serialize($Category);
    	return View::create($res, Response::HTTP_OK);
    }
    /**
     * Delete an Category resource
     * @Rest\Put("/Category/{id}")
     * @param Request $request
     * @return View
     */
    public function PutCategory(request $request): View
    {
    	$Category=$this->deserialize($request->getData());
    		
        $em = $this->getDoctrine()->getManager();
        $em->remove($Category);
        $em->flush();
    	
    	$res=serialize($Category);
    	return View::create($res, Response::HTTP_OK);
    }

}