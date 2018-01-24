<?php

class User_model extends CI_Model{

    public function getLoginDetail($condition = array())
    {

        $this->db->select('u.id as user_id, access_token, email, mobile_number as phone_number, country_code, created, status, twitter_id, fb_id, phone_verify, 0 as subscription, IFNULL(pin, "") as pin', false);
        $this->db->from('qe_user as u');
        //$this->db->where('u.status !=', USER_DELETED);

        if (isset($condition['access_token']) && !empty($condition['access_token'])) {
            $this->db->where('u.access_token', $condition['access_token']);
        }

        if (isset($condition['email']) && !empty($condition['email'])) {
            $this->db->select("IFNULL(password, '') as password");
            $this->db->where('u.id', $condition['email']);
        }
        return $this->db->get()->row_array();
    }

}