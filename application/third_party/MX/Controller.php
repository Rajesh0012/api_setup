<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/** load the CI class for Modular Extensions **/
require dirname(__FILE__).'/Base.php';

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link	http://codeigniter.com
 *
 * Description:
 * This library replaces the CodeIgniter Controller class
 * and adds features allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Controller.php
 *
 * @copyright	Copyright (c) 2015 Wiredesignz
 * @version 	5.5
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/
class MX_Controller 
{
	public $autoload = array();
	
	public function __construct() 
	{
		$class = str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this));
		log_message('debug', $class." MX_Controller Initialized");
		Modules::$registry[strtolower($class)] = $this;	
		
		/* copy a loader instance and initialize */
		$this->load = clone load_class('Loader');
		$this->load->initialize($this);	
		
		/* autoload module items */
		$this->load->_autoloader($this->autoload);
	}
	
	public function __get($class) 
	{
		return CI::$APP->$class;
	}

    public function html($page = '',$data = ''){

        if(isset($page) && !empty($page))
        {
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view($page);
            $this->load->view('footer');
        }

    }

    public function file_upload($path = NULL,$imagename = NULL)
    {

        if(!empty($imagename) || !empty($path))
        {
            try {

                $config['upload_path'] = $path;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['file_ext_tolower'] = TRUE;
                $config['max_size'] = 5120;
                $config['remove_spaces'] = TRUE;
                $config['detect_mime'] = TRUE;

                $randname = date('Y-m-d h:i:s ssss');
                $config['file_name'] = str_replace(':', '', str_replace('-', '', $randname)) . '_Checkiodds';
                 $this->load->library('upload', $config);

                $this->upload->initialize($config);

                 if ($this->upload->do_upload($imagename)) {
                    $data = $this->upload->data();
                     $resize['image_library'] = 'gd2';
                     $resize['source_image'] = $path.'/'.$data['orig_name'];
                     $resize['create_thumb'] = TRUE;
                    // $resize['maintain_ratio'] = TRUE;
                     $resize['width']   = 200;
                     $resize['height']  = 150;
                     //$resize['quality']  = '100%';
                     $resize['new_image']  = $path.'/'.$data['orig_name'];

                     $this->load->library('image_lib', $resize);
                     $this->image_lib->initialize($resize);

                     $this->image_lib->resize();

                     if ( ! $this->image_lib->resize())
                     {
                         echo $this->image_lib->display_errors();
                     }
                    return ($data['orig_name']);
                } else {
                    $error = $this->upload->display_errors();
                    return $error;
                }

            }catch ( Exception $ex){
                return $ex->getMessage();
            }


        }else{
            return false;
        }
    }
}