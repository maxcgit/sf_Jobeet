<?php
namespace Max\JobeetBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Max\JobeetBundle\Entity\Category;
 
/**
* Category controller
*
*/
class CategoryController extends Controller
{
 
    /**
     * Lists category
     *
     * @Route("/category/{slug}", name="max_category")
     * @Template
     */
	public function showAction($slug)
	{
	    $em = $this->getDoctrine()->getManager();
	 
	    $category = $em->getRepository('MaxJobeetBundle:Category')->findOneBySlug($slug);
	 
	    if (!$category) {
	        throw $this->createNotFoundException('Unable to find Category entity.');
	    }
	 
	    $category->setActiveJobs($em->getRepository('MaxJobeetBundle:Job')->getActiveJobs($category->getId()));
	 
	    return array(
	        'category' => $category,
	    );
	}

}