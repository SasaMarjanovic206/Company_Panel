<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Employee;

class Company extends Model
{
    use HasFactory;

    protected $table = "companies";

    protected $fillable = [
        'name',
        'email',
        'logo',
        'website',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
