<?php
require APPPATH.'libraries/Authentication.php';

class My_api extends Authentication
{



    public function index_get(){

        $access_token = $this->getAccessToken();
        $this->checkLogin($access_token);
        echo 'hello Api';
    }

}