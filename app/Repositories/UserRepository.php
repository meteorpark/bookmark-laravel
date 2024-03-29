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
     * @param string $join_type
     * @param string $sns_id
     * @return mixed
     */
    public function getSnsId(string $join_type, string $sns_id)
    {
        return User::where('sns_id', $sns_id)->where('join_type', $join_type)->first();
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
     * @return mixed
     */
    public function delete()
    {
        User::find(auth()->user()->id)->delete();
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
