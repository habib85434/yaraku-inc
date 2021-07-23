<?php


namespace App\Repositories;

use App\Models\AccessToken;
use App\Models\AppLog;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var int
     */
    public $record = 15;

    /**
     * @var Model
     */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    function serverTime ()
    {
        return now();
    }

    function all($orderBy = 'created_at', $order = 'desc')
    {
        return $this->model->orderBy($orderBy, $order)->get();
    }

    function paginate($perPage = 15, $orderBy = 'created_at', $order = 'desc')
    {
        return $this->model->orderBy($orderBy, $order)->paginate($perPage);
    }

    public function paginateByUser($userId, $perPage = 15, $orderBy = 'created_at', $order = 'desc')
    {
        return $this->model
            ->where('user_id', '=', $userId)
            ->orderBy($orderBy, $order)
            ->paginate($perPage);
    }

    function find($id)
    {
        $result = $this->model->find($id);
//        if (empty($result)) {
//            throw new NotFoundResourceException("No result found!");
//        }
        return $result;
    }

    function findByUser($id, $userId)
    {
        $result = $this->model
            ->where('id', '=', $id)
            ->where('user_id', '=', $userId)
            ->first();
        if (empty($result)) {
            throw new NotFoundResourceException("No result found!");
        }
        return $result;
    }

    function store(array $data)
    {
        return $this->model->create($data);
    }

    function storeAll(array $data)
    {
        return $this->model->insert($data);
    }

    function update($id, array $data)
    {
        $result = $this->model->find($id);
        if (empty($result)) {
            throw new NotFoundResourceException("No result found!");
        }
        $result->update($data);
        return $this->find($id);
    }


    function updateByUser($id, array $data, $userId)
    {
        $this->model
            ->where('id', '=', $id)
            ->where('user_id', '=', $userId)
            ->update($data);

        return $this->find($id);
    }

    function delete($id)
    {
        $result = $this->model->find($id);
        if (empty($result)) {
            throw new NotFoundResourceException("No result found!");
        }
        return $result->delete();
    }

    function deleteByUser($id, $userId)
    {
        $result = $this->model
            ->where('id', '=', $id)
            ->where('user_id', '=', $userId)
            ->first();
        if (empty($result)) {
            throw new NotFoundResourceException("No result found!");
        }
        return $result->delete();

    }

    function userByEmail(string $email)
    {
        $result = $this->model
            ->where('email', '=', $email)
            ->first();
        if (empty($result)) {
            throw new NotFoundResourceException("No result found!");
        }
        return $result;
    }

    function appLog(array $data)
    {
        try {
            AppLog::create($data);
        } catch ( \Throwable $throwable ) {
            Log::error('app_log data could not insert.');
        }
    }

    function accessToken(array $data, int $userId)
    {
        try {
            $isExist = AccessToken::where('user_id', '=', $userId)->first();
            if ( empty($isExist) ) {
                //insert
                AccessToken::create($data);
            } else {
                //update
                AccessToken::where('user_id', '=', $userId)->update($data);
            }

        } catch ( \Throwable $throwable ) {
            Log::error('access token data could not insert.');
        }
    }

    function userActive(int $id)
    {
        try {
            User::where('id', '=',  $id )->update(['active' => 1]);
        } catch ( \Throwable $throwable ) {
            Log::error('user data could not updated.');
        }
    }
}

