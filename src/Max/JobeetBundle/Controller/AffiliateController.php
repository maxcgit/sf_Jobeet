<?php

namespace Max\JobeetBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Max\JobeetBundle\Entity\Affiliate;
use Max\JobeetBundle\Form\AffiliateType;
use Symfony\Component\HttpFoundation\Request;
use Max\JobeetBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
 

/**
 * Job controller.
 *
 * @Route("/{_locale}/aff", requirements={"_locale": "uk|ru|en"})
 */
class AffiliateController extends Controller
{
    /**
     * New 
     *
     * @Route("/new", name="max_aff_new")
     * @Method("GET")
     * @Template
     */
    public function newAction()
    {
        $entity = new Affiliate();
        $form = $this->createForm(new AffiliateType(), $entity);
 
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * create 
     *
     * @Route("/", name="max_aff_create")
     * @Method("POST")
     * @Template("MaxJobeetBundle:Affiliate:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $affiliate = new Affiliate();
        $form = $this->createForm(new AffiliateType(), $affiliate);
        $form->bind($request);
 
        if ($form->isValid()) {
 
 	        $em = $this->getDoctrine()->getManager();
            $em->persist($affiliate);
            $em->flush();
 
            return $this->redirect($this->generateUrl('max_aff_wait'));
        }
 
        return array(
            'entity' => $affiliate,
            'form'   => $form->createView(),
        );
    }

    /**
     * wait 
     *
     * @Route("/wait", name="max_aff_wait")
     * @Method("GET")
     * @Template
     */
    public function waitAction(){
    	return array();
    }
}