<?php

namespace App\Listeners;

use App\Events\CompanyCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Models\Company;
use App\Mail\CreatedCompanyInfo;

class SendCompanyCreatedEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CompanyCreated  $event
     * @return void
     */
    public function handle(CompanyCreated $event)
    {
        $company = Company::findOrFail($event->companyId);

        Mail::to($event->email)->send(new CreatedCompanyInfo($company));
    }
}
