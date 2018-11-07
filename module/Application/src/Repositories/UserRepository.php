<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 06.11.18
 * Time: 1:59
 */

namespace Application\Repositories;


use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function getUsers()
    {
        return $this->findAll();
    }
}