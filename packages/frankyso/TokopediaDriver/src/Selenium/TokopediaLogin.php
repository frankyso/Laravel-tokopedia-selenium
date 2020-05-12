<?php


namespace Frankyso\Tokopedia\Selenium;

use Frankyso\Tokopedia\TokopediaBrowser;

class TokopediaLogin extends TokopediaBrowser implements SeleniumProcess
{
    /**
     * @throws \Facebook\WebDriver\Exception\TimeOutException
     */
    public function execute()
    {
        $this->browser->visit("https://www.tokopedia.com/");
        $this->browser->press("Login");
        $this->browser->waitFor(".css-96wq3o");
        $this->browser->mouseover(".css-96wq3o");
        $this->browser->type(".css-96wq3o", $this->params['email']);
        $this->browser->press("Selanjutnya");
        $this->browser->mouseover(".css-96wq3o");
        $this->browser->waitFor(".css-96wq3o");
        $this->browser->type(".css-96wq3o", $this->params['password']);
        $this->browser->pause(2000);
        $this->browser->press("Masuk");

        $this->browser->waitFor("#cotp__method--wa");
        $this->browser->click("#cotp__method--wa");

        $this->browser->waitFor("#otp-number-input-1");
        $this->browser->type("#otp-number-input-1",1);
        $this->browser->type("#otp-number-input-2",2);
        $this->browser->type("#otp-number-input-3",3);
        $this->browser->type("#otp-number-input-4",4);
//        cotp__method--sms
        $this->browser->pause(10000);
    }
}

// and it will waiting the response until the data received
// With Header Token
// {
//    requestTimestamps : microtime
//    requestPayload:{
//        email
//        password
//      }
// }

// data structure on files
// filename should be uuid name
// and file should be array encoded type
// encoded structure
//
// [
//      "status"  => WAITING_OTP, LOGGED_OUT, LOGGED_IN, UPLOADING_PRODUCT, UPLOAD_PRODUCT_FAILED
//      "requestPayload" => //should content incoming request
//      "responsePayload" =>  //should contain outgoing request
// ]
//
//
//
//
//
//