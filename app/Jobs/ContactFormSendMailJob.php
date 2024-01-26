<?php

namespace App\Jobs;

use App\Mail\ContactFormSendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ContactFormSendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $info;
    /**
     * Create a new job instance.
     */
    public function __construct($info)
    {
        $this->info = $info;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to(Config::get('sabin.kr.stha@gmail.com'))
            ->send(
                new ContactFormSendMail($this->info)
            );
    }
}
