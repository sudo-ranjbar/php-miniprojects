<?php

namespace App\Middleware;
use hisorange\BrowserDetect\Parser as Browser;

use App\Middleware\Contract\MiddlewareInterface;

class GlobalMiddleware implements MiddlewareInterface{
    public function handle(){
        $this->blockUSA();
        $this->blockChina();
        $this->sanitizeGetParams();
    }

    public function blockChina(){
        // if(from china){
        //     die('China was blocked');
        // }
    }
    public function blockUSA(){
        // if(from USA){
        //     die('USA was blocked');
        // }
    }

    public function sanitizeGetParams(){
        foreach($_GET as $key => $value){
            $_GET[$key] = xss_clean($value);
        }
    }


}