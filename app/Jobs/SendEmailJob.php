<?php

namespace App\Jobs;

use App\Mail\SendEmailDemo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $send_mail;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($send_mail)
    {
        //
        $this->send_mail = $send_mail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $email = new SendEmailDemo();
        Mail::to($this->send_mail)->send($email);
        
    }
}
