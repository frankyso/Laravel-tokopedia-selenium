<?php


namespace Frankyso\Tokopedia\Selenium;
use Frankyso\Tokopedia\TokopediaBrowser;
use Facebook\WebDriver\Exception\TimeOutException;

class TokopediaScanMessage extends TokopediaBrowser implements SeleniumProcess
{
    public function execute()
    {
        try {
            $this->closeBrowser();
        } catch (TimeOutException $e) {
            $this->closeBrowser();
        }
    }

}