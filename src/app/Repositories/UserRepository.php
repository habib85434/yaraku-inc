<?php


namespace App\Repositories;


use App\Models\AccessToken;
use App\Models\Monday\Workspace;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\RepositoryInterfaces\EmailRepositoryInterface;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
}

