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
         $qb->orderBy('a.date_depos', 'DESC');
         return $qb->getQuery();            
    } 
    
    public function getClientDemandeExportActive($id)
    {
         $qb = $this->createQueryBuilder('a');
         $qb->where('a.client = :client')
            ->andWhere('a.tacking = 0')     
            ->andWhere('a.jobend = 0')          
            ->andWhere('a.annuler = 0')               
            ->setParameter('client', $id)
            ->orderBy('a.date_depos', 'DESC');
         return $qb->getQuery();            
    } 
    
    public function getClientDemandeExportArchive($id)
    {
         $qb = $this->createQueryBuilder('a');
         $qb->where('a.client = :client')
            ->andWhere('a.tacking = 0')     
            ->andWhere('a.jobend = 0')           
            ->andWhere('a.annuler = 1')          
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
            ->andWhere('a.jobend = 0')           
            ->andWhere('a.annuler = 0')                     
            ->setParameter('client', $id)
            ->orderBy('a.date_depos', 'DESC');
         return $qb->getQuery();            
    } 
    
    public function getClientContratTerminer($id)
    {
         $qb = $this->createQueryBuilder('a');
         $qb->where('a.client = :client')
            ->andWhere('a.tacking = 1')     
            ->andWhere('a.jobend = 1')           
            ->andWhere('a.annuler = 0')                     
            ->setParameter('client', $id)
            ->orderBy('a.date_depos', 'DESC');
         return $qb->getQuery();            
    } 
    
//    public function getDemandeExportById($id)
//    {
//         $qb = $this->createQueryBuilder('a');
//         $qb->where('a.id = :id')
//            ->setParameter('id', $id);            
//         return $qb->getQuery()->execute();
//    } 
}
