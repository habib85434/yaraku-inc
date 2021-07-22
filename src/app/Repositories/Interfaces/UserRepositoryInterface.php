<?php


namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function findByEmail($emailAddress );
    public function findUser($prsId, $emailAddress);
    public function findUserByToken($token);
}
