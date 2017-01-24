<?php
namespace App\Traits;

use Request;
use ReCaptcha\ReCaptcha;

trait CaptchaTrait {

    public function captchaCheck($secret)
    {

        $response = Request::input('g-recaptcha-response');
        $remoteip = $_SERVER['REMOTE_ADDR'];

        $recaptcha = new ReCaptcha($secret);
        $resp = $recaptcha->verify($response, $remoteip);
        if ($resp->isSuccess()) {
            return true;
        } else {
            return false;
        }

    }

}