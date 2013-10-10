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
    
    // utilise 0 pour une valeur forcé
    // 1: à l'Admin -> Client Inscrit
    // 2: à l'Admin -> Affréteur Inscrit
    
    public function NzoSendMail($to, $sj) 
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
            $sujet = 'Désactivation de Compte';
            $body  = $this->templating->render('NzoTunisiefretBundle:Front:NotifEmailAdmin.html.twig', 
                    array('message' => 'Nouveau Affréteur Inscrit' )); 
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