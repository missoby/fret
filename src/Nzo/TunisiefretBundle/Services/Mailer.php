<?php

namespace Nzo\TunisiefretBundle\Services; 
use Symfony\Component\Templating\EngineInterface; 

class Mailer 
{ 
    protected $mailer; 
    protected $templating; 
    private $from = "no-reply@tunisie-fret.com";  
    private $nom = 'Tunisie Fret';
            
    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating) 
    { 
        $this->mailer = $mailer; 
        $this->templating = $templating; 
        
    } 

    
    public function NzoSendMail($to, $sj, $nom=null, $txt=null) 
    {         
        
        if($sj==1)
        {
            $sujet = 'Notification Tunisie Fret';
            $body  = $this->templating->render('NzoTunisiefretBundle:Front:NotifEmailAdmin.html.twig', 
                    array('message' => 'Nouveau Client Inscrit' )); 
        }   
        else if($sj==2)
        {
            $sujet = 'Notification Tunisie Fret';
            $body  = $this->templating->render('NzoTunisiefretBundle:Front:NotifEmailAdmin.html.twig', 
                    array('message' => 'Nouveau Affréteur Inscrit' )); 
        }      
        else if($sj==3)
        {
            $sujet = 'Activation de Compte';
            $body  = $this->templating->render('NzoTunisiefretBundle:Front:EmailUser.html.twig', 
                    array('message' => 'On vous informe, que votre compte est désormais active', 
                        'nom' => $nom )); 
        }   
        else if($sj==4)
        {
            $sujet = 'Désactivation de Compte';
            $body  = $this->templating->render('NzoTunisiefretBundle:Front:EmailUser.html.twig', 
                    array('message' => 'On vous informe, que votre compte a été est désactivé!', 
                        'nom' => $nom )); 
        }   
        else if($sj==5)
        {
            $sujet = 'Contrat de Fret Terminé';
            $body  = $this->templating->render('NzoTunisiefretBundle:Front:EmailUser.html.twig', 
                    array('message' => $txt, 
                        'nom' => $nom )); 
        }   
        else if($sj==6)
        {
            $sujet = 'Contrat de Fret Commencé';
            $body  = $this->templating->render('NzoTunisiefretBundle:Front:EmailUser.html.twig', 
                    array('message' => $txt, 
                        'nom' => $nom )); 
        }  
        else if($sj==7)
        {
            $sujet = 'Demande de Fret Annulé';
            $body  = $this->templating->render('NzoTunisiefretBundle:Front:EmailUser.html.twig', 
                    array('message' => $txt, 
                        'nom' => $nom )); 
        }  
        else if($sj==8)
        {
            $sujet = 'Vous avez reçu un Avis';
            $body  = $this->templating->render('NzoTunisiefretBundle:Front:EmailUser.html.twig', 
                    array('message' => $txt, 
                        'nom' => $nom )); 
        }  
        else if($sj==9)
        {
            $sujet = 'Nouveau Postule Reçu';
            $body  = $this->templating->render('NzoTunisiefretBundle:Front:EmailUser.html.twig', 
                    array('message' => $txt, 
                        'nom' => $nom )); 
        }  
        else if($sj==10)
        {
            $sujet = 'Postule Supprimé';
            $body  = $this->templating->render('NzoTunisiefretBundle:Front:EmailUser.html.twig', 
                    array('message' => $txt, 
                        'nom' => $nom )); 
        }  
        else if($sj==11)
        {
            $sujet = 'Avis Reçu';
            $body  = $this->templating->render('NzoTunisiefretBundle:Front:EmailUser.html.twig', 
                    array('message' => $txt, 
                        'nom' => $nom )); 
        } 
        else if($sj==12)
        {
            $sujet = 'Demande Supprimé par l\'Administrateur!';
            $body  = $this->templating->render('NzoTunisiefretBundle:Front:EmailUser.html.twig', 
                    array('message' => $txt, 
                        'nom' => $nom )); 
        } 
        else if($sj==13)
        {
            $sujet = 'Demande Signalé!';
            $body  = $this->templating->render('NzoTunisiefretBundle:Front:NotifEmailAdmin.html.twig', 
                    array('message' => 'une Demande est vient d\'être Signalé!' )); 
        } 
        else if($sj==14)
        {
            $sujet = 'Postule Signalé!';
            $body  = $this->templating->render('NzoTunisiefretBundle:Front:NotifEmailAdmin.html.twig', 
                    array('message' => 'un Postule est vient d\'être Signalé!' )); 
        } 
        else if($sj==15)
        {
            $sujet = 'Message reçu'; 
            $body  = $this->templating->render('NzoTunisiefretBundle:Front:EmailUser.html.twig', 
                    array('message' => $txt, 
                        'nom' => $nom )); 
        }  
        
        $mail = \Swift_Message::newInstance(); 
        $mail ->setFrom($this->from, $this->nom) 
                ->setTo($to) 
                ->setSubject($sujet) 
                ->setBody($body) 
                ->setContentType('text/html'); 
        $this->mailer->send($mail); 
        
    } 
    
}