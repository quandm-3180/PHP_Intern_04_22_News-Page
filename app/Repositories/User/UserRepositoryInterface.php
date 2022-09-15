<?php

namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getUserList();

    public function getUser($id);

    public function getWrites();

    public function getUsers();

    public function createUser($option);
}
