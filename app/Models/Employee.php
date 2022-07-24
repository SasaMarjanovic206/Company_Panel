<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

use App\Models\Company;

class Employee extends Model
{
    use HasFactory, Searchable;

    public $asYouType = true;

    protected $table = "employees";

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function toSearchableArray()
    {
        $array = $this->withoutRelations()->toArray();

        return $array;
    }
}
