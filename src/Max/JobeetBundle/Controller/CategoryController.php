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
     * @Route("/category/{slug}/{page}", name="max_category", defaults={"page" = 1})
     * @Template
     */
	public function showAction($slug, $page)
	{
	    $em = $this->getDoctrine()->getManager();
	 
	    $category = $em->getRepository('MaxJobeetBundle:Category')->findOneBySlug($slug);
	 
	    if (!$category) {
	        throw $this->createNotFoundException('Unable to find Category entity.');
	    }
	 
		$total_jobs = $em->getRepository('MaxJobeetBundle:Job')->countActiveJobs($category->getId());
		$jobs_per_page = $this->container->getParameter('max_jobs_on_category');
		$last_page = ceil($total_jobs / $jobs_per_page);
		$previous_page = $page > 1 ? $page - 1 : 1;
		$next_page = $page < $last_page ? $page + 1 : $last_page;
		$category->setActiveJobs($em->getRepository('MaxJobeetBundle:Job')->getActiveJobs($category->getId(), $jobs_per_page, ($page - 1) * $jobs_per_page));

	    return array(
	        'category' => $category,
	        'last_page' => $last_page,
	        'previous_page' => $previous_page,
	        'current_page' => $page,
	        'next_page' => $next_page,
	        'total_jobs' => $total_jobs,
	        'feedId' => sha1($this->get('router')->generate('max_category', array('slug' =>  $category->getSlug(), '_format' => 'atom'), true)),
	    );
	}

}