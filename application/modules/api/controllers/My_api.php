<?php
require APPPATH.'libraries/Authentication.php';

class My_api extends Authentication
{



   /* public function index_get(){

        $access_token = $this->getAccessToken();
        $this->checkLogin($access_token);
        echo 'hello Api';
    }*/

    public function test_post(){


        $formdata = $this->input->post();

        $data['msg'] = 'hello';
        $img = $this->file_upload('assets','imageUrl');

        print_r($img);die;
        $this->html('index',$data);

    }

}