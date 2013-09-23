<?php

namespace Nzo\TunisiefretBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * DemandeExportRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DemandeExportRepository extends EntityRepository
{
    public function getAllDemandeExport()
    {
         $qb = $this->createQueryBuilder('a');
         $qb->where('a.tacking = 0')              
            ->andWhere('a.annuler_demande is NULL')  
            ->orderBy('a.date_depos', 'DESC');
         return $qb->getQuery();            
    } 
    
    public function getClientDemandeExportActive($id)
    {
         $qb = $this->createQueryBuilder('a');
         $qb->where('a.client = :client')
            ->andWhere('a.tacking = 0')              
            ->andWhere('a.annuler_demande is NULL')               
            ->setParameter('client', $id)
            ->orderBy('a.date_depos', 'DESC');
         return $qb->getQuery();            
    } 
    
    public function getClientDemandeExportArchive($id)
    {
         $qb = $this->createQueryBuilder('a');
         $qb->where('a.client = :client')
            ->andWhere('a.tacking = 0')                 
            ->andWhere('a.annuler_demande is NOT NULL')              
            ->setParameter('client', $id)
            ->orderBy('a.date_depos', 'DESC');
         return $qb->getQuery();            
    } 
    
    public function getClientDemandeExportType($id)
    {
         $qb = $this->createQueryBuilder('a');
         $qb->where('a.client = :client')
            ->andWhere('a.demandeexporttype = 1')                   
            ->setParameter('client', $id)
            ->orderBy('a.date_depos', 'DESC');
         return $qb->getQuery();            
    } 
    
    public function getClientContratEncours($id)
    {
         $qb = $this->createQueryBuilder('a');
         $qb->where('a.client = :client')
            ->andWhere('a.tacking = 1')     
            ->andWhere('a.terminer_demande is NULL')                             
            ->setParameter('client', $id)
            ->orderBy('a.date_tacking', 'DESC');
         return $qb->getQuery();            
    } 
    
    public function getClientContratTerminer($id)
    {
         $qb = $this->createQueryBuilder('a');
         $qb->where('a.client = :client')    
            ->andWhere('a.terminer_demande is NOT NULL')                            
            ->setParameter('client', $id)
            ->orderBy('a.date_depos', 'DESC');
         return $qb->getQuery();            
    } 

    public function getClientNbDemandeExportArchive($id)
    {
         $qb = $this->createQueryBuilder('a');
         $qb->select('COUNT(a)')
            ->where('a.client = :client')
            ->andWhere('a.tacking = 0')                 
            ->andWhere('a.annuler_demande is NOT NULL')              
            ->setParameter('client', $id);
         return $qb->getQuery()->getSingleScalarResult();
    } 
    
    public function getClientContratEncoursTrois($id)
    {
         $qb = $this->createQueryBuilder('a');
         $qb->where('a.client = :client')
            ->andWhere('a.tacking = 1')     
            ->andWhere('a.terminer_demande is NULL')                             
            ->setParameter('client', $id)
            ->orderBy('a.date_tacking', 'DESC')
            ->setMaxResults(3);     
         return $qb->getQuery()->execute();  
    } 
 
}
