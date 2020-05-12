<?php


namespace Frankyso\Tokopedia\Selenium;

use Facebook\WebDriver\Remote\LocalFileDetector;
use Frankyso\Tokopedia\TokopediaBrowser;

class TokopediaUploadProduct extends TokopediaBrowser implements SeleniumProcess
{
    public function execute()
    {
        $this->browser->visit("https://seller.tokopedia.com/add-product");
//        $this->browser->attach('.product-image__drop-area input', __DIR__.'/product.jpg');
//        $this->browser->attach('.product-image__drop-area input', __DIR__.'/product2.jpg');
        $element = $this->browser->resolver->resolveForAttachment(".product-image__drop-area input");
        $element->setFileDetector(new LocalFileDetector)->sendKeys('E:\Development\tokopedia-api\packages\frankyso\TokopediaDriver\src\Selenium\product.jpg \n E:\Development\tokopedia-api\packages\frankyso\TokopediaDriver\src\Selenium\product2.jpg');
//        $element->setFileDetector(new LocalFileDetector)->sendKeys();

//        product-image__drop-area
//        $this->browser->driver->findElement(WebDriverBy::cssSelector(".product-image__upload-title input"))->sendKeys(__DIR__.'/product.jpg');
//        $this->browser->press("Login");
//        $this->browser->waitFor(".css-96wq3o");
//        $this->browser->mouseover(".css-96wq3o");
//        $this->browser->type(".css-96wq3o", $this->params['email']);
//        $this->browser->press("Selanjutnya");
//        $this->browser->mouseover(".css-96wq3o");
//        $this->browser->waitFor(".css-96wq3o");
//        $this->browser->type(".css-96wq3o", $this->params['password']);
//        $this->browser->press("Masuk");
//
//        $this->browser->waitFor("#cotp__method--wa");
//        $this->browser->click("#cotp__method--wa");
//
////        cotp__method--sms
//
//        $this->browser->pause(10000);
//        $this->browser->check('rememberMe');
//        $this->browser->waitFor('._1pw2F', 60);
//        $this->browser->pause(1000);
//        $this->setQrCode($this->browser->attribute('img', "src"), true);
//        $this->browser->waitFor('#pane-side', 60 * 5);
    }
}