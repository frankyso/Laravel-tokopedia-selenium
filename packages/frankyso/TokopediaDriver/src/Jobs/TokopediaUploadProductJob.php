<?php

namespace Frankyso\Tokopedia\Jobs;

use App\PhoneNumber;
use App\Services\WhatsappDriver;
use App\User;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Frankyso\Tokopedia\TokopediaManager;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Storage;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome\ChromeProcess;
use Laravel\Dusk\ElementResolver;

class TokopediaUploadProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $manager;

    /**
     * Create a new job instance.
     *
     * @param $phone
     */
    public function __construct(TokopediaManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->manager->jobProcessor()->uploadProduct();
        return true;
    }
}
