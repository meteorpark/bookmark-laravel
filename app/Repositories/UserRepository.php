<?php


namespace App\Repositories;


use App\Models\User;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository implements UserRepositoryInterface
{

    /**
     * @param string $sns_id
     * @return mixed
     */
    public function getSnsId(string $sns_id)
    {
        return User::where('sns_id', $sns_id)->first();
    }

    /**
     * @param string $user_id
     * @return mixed
     */
    public function get(string $user_id)
    {
        // TODO: Implement get() method.
    }

    /**
     * @return mixed
     */
    public function all()
    {
        // TODO: Implement all() method.
    }

    /**
     * @param string $user_id
     * @return mixed
     */
    public function delete(string $user_id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param string $user_id
     * @param array $user_data
     * @return mixed
     */
    public function update(string $user_id, array $user_data)
    {
        // TODO: Implement update() method.
    }


    /**
     * @param array $user_data
     * @return mixed
     */
    public function create(array $user_data)
    {
        return User::create($user_data);
    }
}
