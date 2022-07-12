<?php

namespace App\Interfaces;

use App\Interfaces\EmployeeRepositoryInterface;

interface EmployeeRepositoryInterface{

    public function store($data);

    public function getOne($id);

    public function delete($id);

}