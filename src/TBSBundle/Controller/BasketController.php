<?php

namespace TBSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TBSBundle\Entity\Basket;
use TBSBundle\Entity\Orderline;
use TBSBundle\Entity\User;
use TBSBundle\Entity\Location;
use TBSBundle\Form\BasketType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class BasketController extends Controller
{

     public function addInBasketAction(Request $request,User $user){
        $em = $this->getDoctrine()->getManager();

        $b = new Basket();
        $form = $this->createForm('TBSBundle\Form\BasketType', $b);

        $o = new Orderline();
        $form2 = $this->createForm('TBSBundle\Form\OrderlineType', $o);
        $form2->handleRequest($request);

        /* On combine un formulaire symfony et un formulaire fait main 
        On ne peut donc pas utiliser isValid() pour la validation du formulaire, on le test à la main */

        $form->handleRequest($request);

        if (isset($_POST['lfinal'])) {
            $location = $_POST['lfinal'];
        }

        if ($form->isSubmitted() && $location != 0) {
            $b->setLId($em->getRepository("TBSBundle:Location")->find($location));
            $b->setId($em->getRepository("TBSBundle:User")->find($user->getId()));
            $b->setBStatus('filling');
            
            $em->persist($b);
            $em->flush();   

            return $this->render('TBSBundle:Orderline:add.html.twig',array('form2'=> $form2->createView(), 'basket'=> $b ));
        }
       

        return $this->render('TBSBundle:Basket:add.html.twig',array('form'=> $form->createView(),));
    }



}