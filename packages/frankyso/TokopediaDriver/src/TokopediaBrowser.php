<?php


namespace Frankyso\Tokopedia;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome\ChromeProcess;
use Laravel\Dusk\ElementResolver;

class TokopediaBrowser
{
    protected $chromeProcess;
    protected $params;
    protected $browser;
    protected $storage;
    protected $whatsapp_url = "https://web.whatsapp.com/";

    /**
     * WhatsAppBrowser constructor.
     * @param $params
     * @param null $identifier
     * @throws \Exception
     */
    public function __construct($params, $identifier = null)
    {
        $this->params = $params;
        $this->startChromeProcess();
        $identifier = ($identifier == null) ? Str::uuid() : $identifier;
        $this->storage = config('tokopedia.selenium.storage') . "/" . $identifier;
        $this->browser = $this->openBrowser();
    }

    /**
     * Starting Chrome Process
     */
    public function startChromeProcess()
    {
        $process = (new ChromeProcess)->toProcess();
        if ($process->isStarted()) {
            $process->stop();
        }
        $process->start();
    }

    /**
     * Open New Browser
     *
     * @return Browser
     * @throws \Exception
     */
    public function openBrowser()
    {
        $this->startChromeProcess();
        $options = (new ChromeOptions)->addArguments(['--disable-gpu', '--disable-notifications', '--no-sandbox', '--user-data-dir=' . $this->storage]);
        $capabilities = DesiredCapabilities::chrome()->setCapability(ChromeOptions::CAPABILITY, $options);
        $driver = retry(5, function () use ($capabilities) {
            return RemoteWebDriver::create('http://localhost:9515', $capabilities, 60000, 60000);
        }, 200);

        $browser = new Browser($driver, new ElementResolver($driver, ''));
        return $browser;
    }

    public function closeBrowser()
    {
        $this->browser->driver->close();
        $this->browser->quit();
    }

    /**
     * @param Browser $browser
     */
    public function setBrowser(Browser $browser): void
    {
        $this->browser = $browser;
    }

    /**
     * @param mixed $chromeProcess
     */
    public function setChromeProcess($chromeProcess): void
    {
        $this->chromeProcess = $chromeProcess;
    }
}