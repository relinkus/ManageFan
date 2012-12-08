<?php defined('BASEPATH') or exit('No direct script access allowed');

class Calendar_categories_m extends MY_Model {
    
    public function __construct()
    {
        parent::__construct();
        parent::set_table_name('calendar_categories');
    }
    
    public function get_category($field, $value)
    {
        return $this->db
                    ->select('*')
                    ->select('(SELECT COUNT(*) FROM '.$this->db->dbprefix('calendar').' WHERE category = '.$this->db->dbprefix('calendar_categories').'.id ) AS total_items')
                    ->where($field, $value)
                    ->limit(1)
                    ->get(parent::table_name())
                    ->row();
    }
    
    public function get_categories()
    {
        return $this->db
                    ->select('*')
                    ->select('(SELECT COUNT(*) FROM '.$this->db->dbprefix('calendar').' WHERE category = '.$this->db->dbprefix('calendar_categories').'.id ) AS total_items')
                    ->order_by('name', 'ASC')
                    ->get(parent::table_name())
                    ->result();
    }
    
}