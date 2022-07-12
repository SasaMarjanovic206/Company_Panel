<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CompanyCreated
{
    use Dispatchable, SerializesModels;

    public $email;
    public $companyId;

    public function __construct($email, $companyId)
    {
        $this->email = $email;
        $this->companyId = $companyId;
    }

}
