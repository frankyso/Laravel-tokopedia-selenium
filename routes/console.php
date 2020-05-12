<?php

use Frankyso\Tokopedia\Selenium\TokopediaLogin;
use Frankyso\Tokopedia\Selenium\TokopediaUploadProduct;
use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('login', function () {
//    $tokopedia = new \Frankyso\Tokopedia\TokopediaManager();
//    $toped = (new TokopediaLogin([
//        "email" => "frankyso.mail@gmail.com",
//        "password" => "rain180511"
//    ]))->execute();

    $toped = (new TokopediaUploadProduct([
        "email" => "frankyso.mail@gmail.com",
        "password" => "rain180511"
    ], "56dd6d40-11b5-4286-a54e-fc6cad75c4a"))->execute();

//    $tokopedia->uploadProduct([
//        "email" => "frankyso.mail@gmail.com",
//        "password" => "rain180511"
//    ]);
});