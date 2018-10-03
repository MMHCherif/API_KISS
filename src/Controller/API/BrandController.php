<?php
namespace App\Controller\API;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use App\Entity\Brand;
use FOS\RestBundle\View\View ;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use JMS\Serializer;
use App\Repository\BrandRepository;
class BrandController extends FOSRestController 
{
	 /**
     * Creates an Product resource
     * @Rest\Post("/Brand")
     * 
     * @param Request $request
     * @return View
     */
    public function postBrand(Request $request): View
    {
       	$brand = new Brand();
        $Brand->setName($request->get('name'));
        $Brand->setId(md5($request->get('id')));
        $em = $this->getDoctrine()->getManager();
        $em	->add($Brand);
           $em->flush();
        $this->serialize($Brand,'JSON')  ; 
        return View::create($Brand, Response::HTTP_OK);
    }
     /**
     * Retrieves an Brand resource
     * @Rest\Get("/Brand/{id}")
     */
   
    public function getBrand($id): View
    {
        $Brand = $this->getDoctrine()
        				->getRepository(Brand::class)
        				->find($id)
        				;
        $this->serialize($Brand,'JSON')  ; 
        return View::create($Brand, Response::HTTP_OK);
    }
    /**
     * Delete an Brand resource
     * @Rest\Delete("/Brand/{id}")
     * @param IdBrand
     * @return View
     */
    public function DeleteBrand($id): View
    {
    	if ($this->isCsrfTokenValid('delete'.$Brand->getId(), $request->request->get('_token'))) 
    	{
            $em = $this->getDoctrine()->getManager();
            $em->remove($Brand);
            $em->flush();
    	}
    	$res=serialize($Brand);
    	return View::create($res, Response::HTTP_OK);
    }
    /**
     * Delete an Brand resource
     * @Rest\Put("/Brand/{id}")
     * @param Request $request
     * @return View
     */
    public function PutBrand(request $request): View
    {
    	$Brand=$this->deserialize($request->getData());
    		
        $em = $this->getDoctrine()->getManager();
        $em->remove($Brand);
        $em->flush();
    	
    	$res=serialize($Brand);
    	return View::create($res, Response::HTTP_OK);
    }

}