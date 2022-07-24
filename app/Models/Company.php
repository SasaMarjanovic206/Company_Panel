<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

use App\Models\User;
use App\Models\Employee;

class Company extends Model
{
    use HasFactory, Searchable;

    public $asYouType = true;

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

    public function setLogoAttribute($value)
    {
        if($value == ''){
            $this->attributes['logo'] = null;
        }
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        return $array;
    }

}
