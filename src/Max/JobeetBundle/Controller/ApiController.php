<?php
namespace Max\JobeetBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Max\JobeetBundle\Entity\Affiliate;
use Max\JobeetBundle\Entity\Job;
use Max\JobeetBundle\Repository\AffiliateRepository;
 
/**
  * @Route("/api")
  */ 
class ApiController extends Controller
{
    /**
     * Lists 
     *
     * @Route("/{token}/jobs.{_format}", name="max_api", requirements={"_format" : "json|yaml"})
     * @Template
     */
    public function listAction(Request $request, $token)
    {
        $em = $this->getDoctrine()->getManager();
 
        $jobs = array();
 
        $rep = $em->getRepository('MaxJobeetBundle:Affiliate');
        $affiliate = $rep->getForToken($token);
 
        if(!$affiliate) {
            throw $this->createNotFoundException('This affiliate account does not exist!');
        }
 
        $rep = $em->getRepository('MaxJobeetBundle:Job');
        $active_jobs = $rep->getActiveJobs(null, null, null, $affiliate->getId());
 
        foreach ($active_jobs as $job) {
            $jobs[$this->get('router')->generate('max_job_show', array('company' => $job->getCompanySlug(), 'location' => $job->getLocationSlug(), 'id' => $job->getId(), 'position' => $job->getPositionSlug()), true)] = $job->asArray($request->getHost());
        }
 
        // $format = $request->getRequestFormat();
 
        // if ($format == "json") {
        //     $headers = array('Content-Type' => 'application/json');
        //     $response = new Response(json_encode($jobs), 200, $headers);
 
        //     return $response;
        // }
 
        return array('jobs' => $jobs);  
    }
}