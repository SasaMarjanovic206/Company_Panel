<?php

namespace App\Interfaces;

use App\Interfaces\CompanyRepositoryInterface;

interface CompanyRepositoryInterface{
    
    public function getAll();

    public function store($data, $userId, $path);

    public function getOne($id);

    public function update($data, $company, $path);

    public function delete($id);
}