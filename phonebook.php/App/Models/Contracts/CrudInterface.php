<?php

namespace App\Models\Contracts;

interface CrudInterface
{

    # Create (INSERT)
    public function create(array $data) : int;



    # Read (SELECT)
    public function find(int $id) : object|null;
    public function get($columns, array $where) : array;



    # Update (UPDATE)
    public function update(array $where, array $data) : int;



    # Delete (DELETE)
    public function delete(array $where) : int;

}