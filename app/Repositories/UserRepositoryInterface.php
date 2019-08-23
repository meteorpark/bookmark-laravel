<?php


namespace App\Repositories;


/**
 * Interface UserRepositoryInterface
 * @package App\Repositories
 */
interface UserRepositoryInterface
{

    /**
     * @param string $sns_id
     * @return mixed
     */
    public function getSnsId(string $sns_id);

    /**
     * @param string $user_id
     * @return mixed
     */
    public function get(string $user_id);


    /**
     * @param array $user_data
     * @return mixed
     */
    public function create(array $user_data);

    /**
     * @return mixed
     */
    public function all();

    /**
     * @param string $user_id
     * @return mixed
     */
    public function delete(string $user_id);

    /**
     * @param string $user_id
     * @param array $user_data
     * @return mixed
     */
    public function update(string $user_id, array $user_data);
}
