<?php


class admin extends MX_Controller
{



    public function index_get(){

        $access_token = $this->getAccessToken();
        $this->checkLogin($access_token);
        echo 'hello Api';
    }

    public function index()
    {

        $formdata = $this->input->post();

        $data['msg'] = 'hello';
        if(isset($_FILES['image']['name'])){
            $img = $this->file_upload('assets','image');
            print_r($img); die;
        }




      $this->html('index',$data);


    }

}