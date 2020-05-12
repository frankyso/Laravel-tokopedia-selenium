<?php


namespace Frankyso\Tokopedia;

use App\PhoneNumber;
use Frankyso\Tokopedia\Selenium\TokopediaLogin;
use Frankyso\Tokopedia\Selenium\TokopediaUploadProduct;

class TokopediaJobProcessor
{
    protected $integratedPhoneNumber;

    public function __construct()
    {
    }

    public function login($params)
    {
        $authentication = new TokopediaLogin($params);
        return $authentication->execute();
    }

    public function uploadProduct($params)
    {
        $authentication = new TokopediaUploadProduct($params);
        return $authentication->execute();
    }

//    public function sendMessage()
//    {
//        $authentication = new TokopediaSendMessage($this->integratedPhoneNumber);
//        return $authentication->execute();
//    }
//
//    public function scanMessage()
//    {
//        $authentication = new TokopediaScanMessage($this->integratedPhoneNumber);
//        return $authentication->execute();
//    }
//
//    public function authenticate()
//    {
//        $authentication = new TokopediaAuthentication($this->integratedPhoneNumber);
//        return $authentication->execute();
//    }


//    public function send($receiver, $messages)
//    {
//        $messages = is_array($messages) ? $messages : [$messages];
//        $browser = $browser ?? $this->browser();
//        $browser->visit("https://wa.me/$receiver");
//        $browser->waitFor("#main_block", 60);
//        $browser->click("#action-button");
//        $browser->waitFor("._3u328", 60);
//        foreach ($messages as $message) {
//            $browser->mouseover('._3u328');
//            $browser->keys("._3u328", $message);
//            $browser->click("._3M-N-");
//            $browser->pause(500);
//        }
//        $browser->pause(2000);
//        $browser->driver->close();
//        $browser->quit();
//    }
//
//    /**
//     * Scan All Messages and save it into database
//     */
//    public function initMessage()
//    {
//        $browser = $this->browser();
//        $browser->visit('https://web.whatsapp.com/');
//        $browser->waitFor('#pane-side', 60 * 5);
//        $elements = $browser->elements(".X7YrQ");
//        $elements = collect($elements)->sortBy(function ($element) {
//            return str_replace(")", "", explode(",", $element->getCSSValue("transform"))[5]);
//        });
//
//        foreach ($elements as $element) {
//            try {
//                $elementHtml = $element->getAttribute('innerHTML');
//            } catch (\Exception $e) {
//                continue;
//            }
//
//            $isGroup = Str::contains($elementHtml, "default-group");
//            if ($isGroup) {
//                continue;
//            }
//
//            $phone = $this->extractPhoneNumber($element->findElement(WebDriverBy::tagName('img'))->getAttribute('src'));
//            $user = $this->integratedPhoneNumber->user;
//            $contact = $user->contacts()->where('phone', $phone)->first();
//            if ($contact == null) {
//                $contact = new Contact();
//                $contact->phone = $phone;
//                $contact->user_id = $user->id;
//                $contact->save();
//            }
//
//            $browser->driver->getMouse()->mouseMove($element->getCoordinates());
//            $element->click();
//
//            $messageMap = [];
//            $map = Message::where('contact_id', $contact->id)->orderBy('id', 'DESC');
//            $map->get()->each(function ($item) use (&$messageMap) {
//                $messageMap[] = [
//                    "type" => $this->type,
//                    "message" => $item->message,
//                    "delivered_at" => $item->delivered_at
//                ];
//            });
//
//            dd($messageMap);
//
//            $messages = $this->getNewMessages($browser, ["message-in"], $messageMap);
//            foreach ($messages as $message) {
//                $msgAvailable = Message::where('message', $message['message'])->where('contact_id', $contact->id)->where("delivered_at", $message['delivered_at'])->count();
//                if ($msgAvailable > 0) {
//                    continue;
//                }
//                $messageModel = new Message();
//                $messageModel->sequence = 0;
//                $messageModel->message = $message['message'];
//                $messageModel->contact_id = $contact->id;
//                $messageModel->phone_number_id = $this->integratedPhoneNumber->id;
//                $messageModel->delivered_at = $message['delivered_at'];
//                $messageModel->status = Message::STATUS_SENT;
//                $messageModel->save();
//            }
//        }
//        exit;
//
//
////        $phone= $this->extractPhoneNumber($elements[0]->findElement(WebDriverBy::ta('data-icon="default-user"'))->getAttribute('src'));
////        $phone= $this->extractPhoneNumber($elements[0]->findElement(WebDriverBy::ta('data-icon="default-user"'))->getAttribute('src'));
//
////        _3RWII
////        scan:
//    }
//
//    public function read()
//    {
//
//    }
//
//    public function getMessageByNumber($phoneNumber, $browser)
//    {
//
//    }
//
//    /**
//     * @param Browser $browser
//     * @param array $type
//     * @param int $page
//     * @return array
//     */
//    public function getNewMessages(Browser $browser, $type = ['message-in', 'message-out'], $messageMap = [])
//    {
//        $chatElements = $browser->elements(".FTBzM");
//        $messages = [];
//        foreach ($chatElements as $chat) {
//            try {
//                $elementClass = $chat->getAttribute('class');
//                $exist = Str::contains($elementClass, $type);
//                if ($exist) {
//                    $delivered_at = $chat->findElement(WebDriverBy::cssSelector(".copyable-text"))->getAttribute('data-pre-plain-text');
//                    preg_match('#\[(.*?)\]#', $delivered_at, $delivered_at);
//                    $delivered_at = $delivered_at[1];
//                    $carbon = Carbon::createFromFormat("g:i A, m/d/Y", $delivered_at);
//
//                    $messages[] = [
//                        "type" => (Str::contains($elementClass, 'message-in') == Message::TYPE_IN) ? Message::TYPE_IN : Message::TYPE_OUT,
//                        "message" => $chat->findElement(WebDriverBy::cssSelector('.selectable-text span'))->getAttribute('innerHTML'),
//                        "delivered_at" => $carbon->format("Y-m-d H:i:s")
//                    ];
//                }
//            } catch (NoSuchElementException $e) {
//                continue;
//            }
//        }
//
//        return $messages;
//    }
//
//    /**
//     * Scan New Message Coming In
//     */
//    public function scan($phoneNumber = null, $browser = null)
//    {
//        if ($browser == null) {
//            $browser = $this->browser();
//            $browser->visit('https://web.whatsapp.com/');
//            $browser->waitFor('#pane-side', 60 * 5);
//        }
//
//        $chatElements = $browser->elements(".FTBzM");
//        foreach ($chatElements as $chat) {
//            try {
//                $elementClass = $chat->getAttribute('class');
//                $exist = Str::contains($elementClass, ['message-in', 'message-out']);
//                if ($exist) {
//                    $text = $chat->findElement(WebDriverBy::cssSelector('.selectable-text span'))->getAttribute('innerHTML');
//                    echo $text . "<br>";
//                }
//            } catch (NoSuchElementException $e) {
//                continue;
//            }
//        }
//        exit;
//    }
//
//    /**
//     * Menggenerate QRCode via selenium
//     *
//     * @return bool
//     * @throws \Facebook\WebDriver\Exception\TimeOutException
//     */
//    public function qrCode()
//    {
//        $browser = $this->browser(true);
//        try {
//            $this->integratedPhoneNumber->qrcode = null;
//            $this->integratedPhoneNumber->save();
//
//            $browser->visit('https://web.whatsapp.com/');
//            $browser->check('rememberMe');
//            $browser->waitFor('._1pw2F', 60);
//            $browser->pause(1000);
//            $imageBase64 = $browser->attribute('img', "src");
//
//            $this->integratedPhoneNumber->qrCode = $imageBase64;
//            $this->integratedPhoneNumber->save();
//
//            $browser->waitFor('#pane-side', 60 * 5);
//
//            // get phone number and profile picture Url
//            $rawProfilePicture = $browser->attribute('header img', "src");
//            $this->integratedPhoneNumber->phone_number = $this->extractPhoneNumber($rawProfilePicture);
//            $this->integratedPhoneNumber->avatar = $this->extractAvatar($rawProfilePicture);
//
//            //extract name
//            $browser->waitFor('header img', 60);
//            $browser->pause(200);
//            $browser->click('header img');
//            $browser->waitFor(".rK2ei", 60);
//            $browser->pause(200);
//            $name = $browser->element('.rK2ei ._3u328')->getAttribute('innerHTML');
//
//            $this->integratedPhoneNumber->name = $name;
//            $this->integratedPhoneNumber->qrcode = null;
//            $this->integratedPhoneNumber->status = PhoneNumber::STATUS_CONNECTED;
//            $this->integratedPhoneNumber->save();
//
//            $browser->driver->close();
//            $browser->quit();
//            return true;
//        } catch (Exception $exception) {
//            $browser->driver->close();
//            $browser->quit();
//        }
//    }
//
//    private function extractAvatar($rawProfilePicture)
//    {
//        $webWhatsappAvatar = parse_url($rawProfilePicture);
//        parse_str($webWhatsappAvatar['query'], $originalWhatsappAvatar);
//        return $originalWhatsappAvatar['e'];
//    }
//
//    private function extractPhoneNumber($rawProfilePicture)
//    {
//        $webWhatsappAvatar = parse_url($rawProfilePicture);
//        parse_str($webWhatsappAvatar['query'], $originalWhatsappAvatar);
//        return (int)filter_var($originalWhatsappAvatar['u'], FILTER_SANITIZE_NUMBER_INT);
//    }
//
//    /**
//     * Mendapatkan browser
//     *
//     * @return Browser
//     * @throws \Exception
//     */
//    private function browser($login = false)
//    {
//        $process = (new ChromeProcess)->toProcess();
//        if ($process->isStarted()) {
//            $process->stop();
//        }
//        $process->start();
//
//        $options = (new ChromeOptions)->addArguments(['--disable-gpu', '--no-sandbox', '--user-data-dir=' . $this->session]);
//        $capabilities = DesiredCapabilities::chrome()
//            ->setCapability(ChromeOptions::CAPABILITY, $options);
//        $driver = retry(5, function () use ($capabilities) {
//            return RemoteWebDriver::create('http://localhost:9515', $capabilities, 60000, 60000);
//        }, 50);
//
//        $browser = new Browser($driver, new ElementResolver($driver, ''));
//        $browser->maximize();
//
//        // better validate user
//        if ($login == false) {
//            try {
//                $browser->visit('https://web.whatsapp.com/');
//                $browser->whenAvailable(".landing-window", function ($needLogin) {
//                    $this->integratedPhoneNumber->status = PhoneNumber::STATUS_EXPIRED;
//                    $this->integratedPhoneNumber->save();
//                }, 2);
//                exit;
//            } catch (TimeOutException $e) {
////                $this->saveCookies($browser);
//                return $browser;
//            }
//        }
//        return $browser;
//    }
}