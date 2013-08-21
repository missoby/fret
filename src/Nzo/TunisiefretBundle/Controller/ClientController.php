<?php

namespace Nzo\TunisiefretBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Httpfoundation\Response;
use JMS\SecurityExtraBundle\Annotation\Secure;

use Nzo\TunisiefretBundle\Form\DemandeExportType;
use Nzo\TunisiefretBundle\Entity\DemandeExport;
use Nzo\TunisiefretBundle\Entity\DemandeExportPostule;

use Nzo\TunisiefretBundle\Form\MsgDemandeExportType;
use Nzo\TunisiefretBundle\Entity\MsgDemandeExport;

use Nzo\TunisiefretBundle\Entity\NotifMsg;

class ClientController extends Controller {

   /**
    * @Secure(roles="ROLE_CLIENT")
    */
    public function PoserDemandeExportAction(Request $request)
    {
        $usr = $this->get('security.context')->getToken()->getUser();
        $demande = new DemandeExport();
        $demande->setClient($usr);
        $form = $this->createForm(new DemandeExportType(), $demande);
        if ($this->getRequest()->getMethod() === 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $usr->setNbdemandeexportdepose($usr->getNbdemandeexportdepose()+1);
                $em->persist($demande);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', 'c boooonn!');
                return $this->redirect($this->generateUrl('nzo_tunisiefret_homepage'));
            }
        }
        return $this->render('NzoTunisiefretBundle:Client:PoserDemandeExport.html.twig', array('form' => $form->createView()));
    }
    
   /**
    * @Secure(roles="ROLE_CLIENT")
    */
    public function ListeDemandeExportAction()
    {
        $usr = $this->get('security.context')->getToken()->getUser();
            $em = $this->getDoctrine()->getManager();        
            $query = $em->getRepository('NzoTunisiefretBundle:DemandeExport')->getMyDemandeExport($usr->getId());
            $paginator = $this->get('knp_paginator'); 
            $listedemandeexport = $paginator->paginate($query,
            $this->get('request')->query->get('page', 1), 6);         
            return $this->render('NzoTunisiefretBundle:Client:ListeDemandeExport.html.twig', array('listedemandeexport' => $listedemandeexport));
    }
    
    /**
    * @Secure(roles="ROLE_CLIENT")
    */
    public function DetailDemandeExportAction($id)
    {
        $usr = $this->get('security.context')->getToken()->getUser();
            $em = $this->getDoctrine()->getManager();        
            $mydemande = $em->find('NzoTunisiefretBundle:DemandeExport', $id);
       // security access     
            if($mydemande->getClient() != $usr) return $this->redirect($this->generateUrl('nzo_tunisiefret_homepage'));
       // security access   
            $postules = $em->getRepository('NzoTunisiefretBundle:DemandeExportPostule')->getDemandeExportPostuleByDemande($id);
        return $this->render('NzoTunisiefretBundle:Client:DetailDemandeExport.html.twig', array('mydemande' => $mydemande, 'postules' => $postules));
    }

   /**
    * @Secure(roles="ROLE_CLIENT")
    */
    public function DetailDemandeExportPostuleAction(DemandeExportPostule $postule)
    { 
        $usr = $this->get('security.context')->getToken()->getUser();
        // security access 
        if($postule->getDemandeexport()->getClient() != $usr) return $this->redirect($this->generateUrl('nzo_tunisiefret_homepage'));
        // security access  
//        $MsgForm = new MsgDemandeExport();
//        $form = $this->createForm(new MsgDemandeExportType(), $MsgForm);

            $em = $this->getDoctrine()->getManager();        
            $msgs = $em->getRepository('NzoTunisiefretBundle:MsgDemandeExport')->findBy( array('demandeexportpostule' => $postule));
        return $this->render('NzoTunisiefretBundle:Client:DetailDemandeExportPostule.html.twig', array('postule' => $postule, 'msgs' => $msgs));
    }
    
    /**
     * @Secure(roles="ROLE_CLIENT")
     */
    public function MessageClientSendAction(Request $request) 
    {
        if ($request->isXmlHttpRequest()) {
            // save msg
            $msg = $request->request->get('msg');
            $id = $request->request->get('id');                    
            $em = $this->getDoctrine()->getManager();
            $usr = $this->get('security.context')->getToken()->getUser();
            $MsgForm = new MsgDemandeExport();    
            $MsgForm->setClient($usr);                
            $postule = $em->find('NzoTunisiefretBundle:DemandeExportPostule', $id);
            $MsgForm->setDemandeexportpostule($postule);
            $MsgForm->setMessage($msg);
                $em->persist($MsgForm);
                $em->flush();
            // notif Exportateur
            $exportateur = $postule->getExportateur();
            $notifmsg = new NotifMsg();
            $notifmsg->setExportateur($exportateur);
            $notifmsg->setEmetteur($usr->getPrenom().' '.$usr->getNom());
            $notifmsg->setTitredemandeexport($postule->getDemandeexport()->getTitre());
            if (strlen($msg)> 70){
                $text = substr($msg, 0, 70).'...';
                $notifmsg->setText($text);
            }            
            else
                $notifmsg->setText($msg);
            $em->persist($notifmsg);
            $em->flush();

           //  recuperation liste msg
           $msgs = $em->getRepository('NzoTunisiefretBundle:MsgDemandeExport')->findBy( array('demandeexportpostule' => $postule));

           $i = 0;
            foreach ($msgs as $res) {
                $msgdate = $res->getDate()->format('d/m/Y H:i');
                if($usr==$res->getClient() ) $msguser='Moi'; else $msguser=$res->getExportateur()->getPrenom().' '.$res->getExportateur()->getNom();
                $val[$i] = array('date' =>$msgdate, 'msg' => $res->getMessage(), 'user' => $msguser);
                $i++;
            }
        return new Response(json_encode($val));
        }
    }
}