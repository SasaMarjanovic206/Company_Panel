<?php

namespace App\Interfaces;

interface EmployeeRepositoryInterface {

    public function store($data);

    public function getOne($id);

    public function delete($id);

}