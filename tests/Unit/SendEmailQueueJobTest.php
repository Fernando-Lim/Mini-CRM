<?php

namespace Tests\Unit;

use App\Jobs\SendEmailJob;
use App\Mail\SendEmailDemo;
use Tests\TestCase;
use Spatie\TranslationLoader\LanguageLine;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Bus\Dispatcher;
use Illuminate\Support\Testing\Fakes\BusFake;





class SendEmailQueueJobTest extends TestCase
{
    use RefreshDatabase;

    public function testAllowQueueEmail()
    {


        Mail::fake();

        $send_mail = 'lim.liete@gmail.com';
        $email = new SendEmailDemo();
        Mail::to($send_mail)->cc('aylor@example.com')->bcc('eylor@example.com')->queue($email);



        Mail::assertQueued(SendEmailDemo::class, 1);
    }

    public function testAllowJobEmail()
    {

        Bus::fake();

        $send_mail = 'lim.liete@gmail.com';
        $email = new SendEmailDemo();
        Mail::to($send_mail)->cc('aylor@example.com')->bcc('eylor@example.com')->queue($email);



        dispatch(new SendEmailJob($email));
        Bus::assertDispatched(SendEmailJob::class);
    }
}
