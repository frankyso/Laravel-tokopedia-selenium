<?php


namespace Frankyso\Tokopedia;

use App\PhoneNumber;
use Frankyso\Tokopedia\Jobs\TokopediaLoginJob;
use Frankyso\Tokopedia\Jobs\TokopediaUploadProductJob;

class TokopediaManager
{
    protected $jobProcessor;

    /**
     * WhatsAppManager constructor.
     * @param PhoneNumber $integratedWhatsAppNumber
     */

//    protected $jobs = [
//        "uploadProduct" => TokopediaUploadProductJob::class,
//        "login" => TokopediaLoginJob::class
//    ];

    public function __construct()
    {
//        $this->jobProcessor = new TokopediaJobProcessor();
    }

    public function login($params)
    {

        $this->addQueue("login", $params);
    }

    public function uploadProduct($params)
    {
        $this->addQueue("uploadProduct", $params);
    }

    /**
     * Yang mengatur proses dibelakang dengan queue
     * @return BackgroundProcess
     */
    public function jobProcessor()
    {
        return $this->jobProcessor;
    }

    /**
     * Add Queue Process
     *
     * @param $job
     */
    private function addQueue($job, $params)
    {
        $this->jobs[$job]::dispatch($params);
    }
}