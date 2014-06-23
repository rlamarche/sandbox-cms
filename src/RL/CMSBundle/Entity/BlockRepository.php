<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 23/06/14
 * Time: 20:46
 */

namespace RL\CMSBundle\Entity;

use Doctrine\ORM\EntityRepository;

class BlockRepository extends EntityRepository {
    public function loadByName($name)
    {
        $result = $this->getEntityManager()
            ->createQuery(
                'SELECT b FROM RLCMSBundle:Block b WHERE b.name = ?0'
            )
            ->setParameter(0, $name)
            ->getResult();
        return isset($result[0]) ? $result[0] : null;
    }
} 