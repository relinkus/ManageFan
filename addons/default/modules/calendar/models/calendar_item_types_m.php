<?php defined('BASEPATH') or exit('No direct script access allowed');

class Calendar_item_types_m extends MY_Model {
    
    public function __construct()
    {
        parent::__construct();
        parent::set_table_name('calendar_item_types');
    }
    
    public function get_types()
    {
        return $this->db
                    ->select(parent::table_name().'.*')
                    ->select(STREAMS_TABLE.'.stream_name, '.STREAMS_TABLE.'.stream_slug, '.STREAMS_TABLE.'.stream_namespace, '.STREAMS_TABLE.'.about')
                    ->select('(SELECT COUNT(*) FROM '.$this->db->dbprefix('calendar').' WHERE item_type = '.$this->db->dbprefix('calendar_item_types').'.id ) AS total_items')
                    ->join(STREAMS_TABLE, 'stream_id = '.STREAMS_TABLE.'.id', 'left')
                    ->order_by('stream_name')
                    ->get(parent::table_name())
                    ->result();
    }
    
    public function get_type($field, $value)
    {
        return $this->db
                    ->select(parent::table_name().'.*')
                    ->select(STREAMS_TABLE.'.stream_name, '.STREAMS_TABLE.'.stream_slug, '.STREAMS_TABLE.'.stream_namespace, '.STREAMS_TABLE.'.about')
                    ->select('(SELECT COUNT(*) FROM '.$this->db->dbprefix('calendar').' WHERE item_type = '.$this->db->dbprefix('calendar_item_types').'.id ) AS total_items')
                    ->join(STREAMS_TABLE, 'stream_id = '.STREAMS_TABLE.'.id', 'left')
                    ->where($field, $value)
                    ->limit(1)
                    ->get(parent::table_name())
                    ->row();
    }
    
}