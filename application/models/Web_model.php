<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Web_model extends CI_Model {

    public function get_spotlights() {
        if ($this->db->order_by("date", "ASC")->where(array('date >=' => date("Y-m-d")))->get('spotlights')->num_rows() == 0) {
            return $this->db->order_by("date", "DESC")->where(array('date <=' => date("Y-m-d")))->get('spotlights', 3)->result();
        }
        return $this->db->order_by("date", "ASC")->where(array('date >=' => date("Y-m-d")))->get('spotlights')->result();
    }

    public function is_attending($spotlight_id, $user_id) {
        return $this->db->where(array('spotlightID' => $spotlight_id, 'userID' => $user_id))->get('attending')->num_rows() > 0;
    }

    public function instagram_posts() {
        if(!file_exists('./application/cache/belgiancarclub.json'))
            return array();

        return json_decode(read_file('./application/cache/belgiancarclub.json'))->data;
    }

    public function create_entry($spotlightInfo) {
        $this->db->select('*');
        $this->db->from('attending');
        $this->db->where('userID', $spotlightInfo['userID']);
        $query = $this->db->get();
        $notExists = True;
        foreach ($query->result_array() as $row) {
            if ($row['spotlightID'] == $spotlightInfo['spotlightID']) $notExists = False;
        }
        if ($notExists) $this->db->insert('attending', $spotlightInfo);
    }
}
