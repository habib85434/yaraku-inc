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

    public function findByEmail($emailAddress)
    {
        try {
            return $this->model->where('email', '=', $emailAddress)->first();
        } catch (\Throwable $throwable) {
            throw new \Exception($throwable->getMessage());
        }
    }

    public function findUser($prsId, $emailAddress)
    {
        try {
            $user = $this->model
                ->where('id', '=', $prsId)
                ->orWhere('email', '=', $emailAddress)
                ->first();

            if (empty($user)) {
                throw new NotFoundResourceException("No result found!");
            }
            return $user;
        } catch (\Throwable $throwable) {
            throw new \Exception($throwable->getMessage());
        }
    }

    public function findUserByToken($token)
    {
        try {
            $tokenDetails = AccessToken::where('token', '=', $token)->first();
            if (!empty($tokenDetails)) {
                return $this->model->where('id', '=', $tokenDetails->user_id)->first();
            }
            return null;
        } catch (\Throwable $throwable) {
            throw new \Exception($throwable->getMessage());
        }
    }
}

