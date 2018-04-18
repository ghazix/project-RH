<?php
/**
 * Created by PhpStorm.
 * User: amine
 * Date: 18/04/18
 * Time: 01:50
 */

namespace AppBundle\Repository;


class UserRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param string $role
     *
     * @return array
     */
    public function findByRole($role)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u')
            ->from($this->_entityName, 'u')
            ->where('u.roles LIKE :roles')
            ->setParameter('roles', '%"'.$role.'"%');

        return $qb->getQuery()->getResult();
    }
}