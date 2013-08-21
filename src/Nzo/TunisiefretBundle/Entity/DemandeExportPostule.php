<?php

namespace Nzo\TunisiefretBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ORM\Table(name="tunisiefret_demande_export_postule")
 * @ORM\Entity(repositoryClass="Nzo\TunisiefretBundle\Entity\Repository\DemandeExportPostuleRepository")
 */
class DemandeExportPostule
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Nzo\UserBundle\Entity\Exportateur")
     */
    private $exportateur;
    
    /**
     * @ORM\ManyToOne(targetEntity="Nzo\TunisiefretBundle\Entity\DemandeExport")
     */
    private $demandeexport;
    
    /**
     * @ORM\Column(name="date_postule", type="datetime")
     * @Assert\NotBlank()
     */
    private $datepostule;
    
    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank()
     */
    protected $description;
    
    /**
     * @ORM\Column(name="duree", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $duree;

    /**
     * @ORM\Column(name="prix", type="float")
     * @Assert\NotBlank()
     */
    private $prix;
    
    /**
     * @var boolean $demande_accepter
     *
     * @ORM\Column(name="demande_accepter", type="boolean")
     */
    private $demande_accepter;
    
    /**
     * @var boolean $demande_refuser
     *
     * @ORM\Column(name="demande_refuser", type="boolean")
     */
    private $demande_refuser;
    
 
    
    public function __construct()
    {
        $this->demande_accepter = false;
        $this->demande_refuser = false;  
        $this->datepostule = new \DateTime('now');
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set datepostule
     *
     * @param \DateTime $datepostule
     * @return DemandeExportPostule
     */
    public function setDatepostule($datepostule)
    {
        $this->datepostule = $datepostule;
    
        return $this;
    }

    /**
     * Get datepostule
     *
     * @return \DateTime 
     */
    public function getDatepostule()
    {
        return $this->datepostule;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return DemandeExportPostule
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set duree
     *
     * @param string $duree
     * @return DemandeExportPostule
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;
    
        return $this;
    }

    /**
     * Get duree
     *
     * @return string 
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set prix
     *
     * @param float $prix
     * @return DemandeExportPostule
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    
        return $this;
    }

    /**
     * Get prix
     *
     * @return float 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set demande_accepter
     *
     * @param boolean $demandeAccepter
     * @return DemandeExportPostule
     */
    public function setDemandeAccepter($demandeAccepter)
    {
        $this->demande_accepter = $demandeAccepter;
    
        return $this;
    }

    /**
     * Get demande_accepter
     *
     * @return boolean 
     */
    public function getDemandeAccepter()
    {
        return $this->demande_accepter;
    }

    /**
     * Set demande_refuser
     *
     * @param boolean $demandeRefuser
     * @return DemandeExportPostule
     */
    public function setDemandeRefuser($demandeRefuser)
    {
        $this->demande_refuser = $demandeRefuser;
    
        return $this;
    }

    /**
     * Get demande_refuser
     *
     * @return boolean 
     */
    public function getDemandeRefuser()
    {
        return $this->demande_refuser;
    }

    /**
     * Set exportateur
     *
     * @param \Nzo\UserBundle\Entity\Exportateur $exportateur
     * @return DemandeExportPostule
     */
    public function setExportateur(\Nzo\UserBundle\Entity\Exportateur $exportateur = null)
    {
        $this->exportateur = $exportateur;
    
        return $this;
    }

    /**
     * Get exportateur
     *
     * @return \Nzo\UserBundle\Entity\Exportateur 
     */
    public function getExportateur()
    {
        return $this->exportateur;
    }

    /**
     * Set demandeexport
     *
     * @param \Nzo\TunisiefretBundle\Entity\DemandeExport $demandeexport
     * @return DemandeExportPostule
     */
    public function setDemandeexport(\Nzo\TunisiefretBundle\Entity\DemandeExport $demandeexport = null)
    {
        $this->demandeexport = $demandeexport;
    
        return $this;
    }

    /**
     * Get demandeexport
     *
     * @return \Nzo\TunisiefretBundle\Entity\DemandeExport 
     */
    public function getDemandeexport()
    {
        return $this->demandeexport;
    }
}