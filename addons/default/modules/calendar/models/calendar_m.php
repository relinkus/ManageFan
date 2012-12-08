<?php defined('BASEPATH') or exit('No direct script access allowed');

class Calendar_m extends MY_Model {
    
    public function __construct()
    {
        parent::__construct();
        parent::set_table_name('calendar');
    }
    
    public function insert_entry($post, $stream_entry_id)
    {
        $data = array(
            'date_start'            => $post['date_start']['date'].' '.$post['date_start']['hour'].':'.$post['date_start']['minute'].':00',
            'date_end'              => $post['date_end']['date'].' '.$post['date_end']['hour'].':'.$post['date_end']['minute'].':00',
            'restricted_to'         => isset($post['restricted_to']) ? in_array('0', $post['restricted_to']) ? '0' : implode(',', $post['restricted_to']) : null,
            'category'              => $post['category'],
            'item_type'             => $post['item_type'],
            'recurrence'            => $post['recurrence'],
            'stream_entry_id'       => $stream_entry_id,
            'created_on'            => now(),
            'updated_on'            => null,
            'created_by'            => $this->current_user->id
        );
        
        return parent::insert($data);
    }
    
    public function update_entry($id, $post, $stream_entry_id)
    {
        $data = array(
            'date_start'            => $post['date_start']['date'].' '.$post['date_start']['hour'].':'.$post['date_start']['minute'].':00',
            'date_end'              => $post['date_end']['date'].' '.$post['date_end']['hour'].':'.$post['date_end']['minute'].':00',
            'restricted_to'         => isset($post['restricted_to']) ? in_array('0', $post['restricted_to']) ? '0' : implode(',', $post['restricted_to']) : null,
            'category'              => $post['category'],
            'recurrence'            => $post['recurrence'],
            'updated_on'            => now(),
        );
        
        return parent::update_by('id', $id, $data);
    }
    
    public function get_entries($year, $month, $categoryid)
    {
        $query = "SELECT ".parent::table_name().".*,
                         ".$this->db->dbprefix('calendar_item_types').".stream_id, ".$this->db->dbprefix('calendar_item_types').".admin_layout, ".$this->db->dbprefix('calendar_item_types').".public_layout,
                         ".$this->db->dbprefix('calendar_categories').".item_color
                  FROM ".parent::table_name()."
                  LEFT JOIN ".$this->db->dbprefix('calendar_item_types')." ON item_type = ".$this->db->dbprefix('calendar_item_types').".id
                  LEFT JOIN ".$this->db->dbprefix('calendar_categories')." ON category = ".$this->db->dbprefix('calendar_categories').".id
                  WHERE ((DATE_FORMAT(date_start, '%Y-%m') = '".$year."-".$month."' AND recurrence = 'once')
                  OR    (DATE_FORMAT(date_start, '%Y-%m') <= '".$year."-".$month."' AND recurrence IN ('daily', 'weekly', 'monthly')) 
                  OR    (DATE_FORMAT(date_start, '%m') = '".$month."' AND recurrence = 'annually' AND DATE_FORMAT(date_start, '%Y') <= '".$year."'))
                  ".($categoryid != 'all' ? " AND category = '".$categoryid."'" : '')."
                  ORDER BY DATE_FORMAT(date_start, '%T') ASC
                 ";
        
        $entries = $this->db->query($query)->result();
        
        if($entries)
        {
            foreach($entries as $key => &$entry)
            {
                $entry->entry = $this->row_m->get_row($entry->stream_entry_id, $this->streams_m->get_stream($entry->stream_id), true);
                $entry->author = $this->ion_auth->get_user($entry->created_by);
                $restrictions = $entry->restricted_to == null ? array() : @explode(',', $entry->restricted_to);
                $groups = array();
                if($restrictions != null)
                {
                    $this->load->model('groups/group_m');
                    foreach($restrictions as $key => $groupid)
                    {
                        if($groupid == 'guests')
                        {
                            $groups[] = 'Guests';
                        }
                        else if($groupid == '0')
                        {
                            $groups[] = '-- Any --';
                        }
                        else
                        {
                            $group = $this->group_m->get_by('id', $groupid);
                            $groups[] = $group->description;
                        }
                    }
                }
                $entry->restrictions = @implode(', ', $groups);
            }
            return $entries;
        }
        
        return null;
        
    }
    
    public function get_day_entries($year, $month, $day, $category)
    {
        $weekday = date('w', mktime(23, 59, 59, $month, $day, $year));
        $mysql_wd = array(
            0   => 6,
            1   => 0,
            2   => 1,
            3   => 2,
            4   => 3,
            5   => 4,
            6   => 5
        );
        $weekday = $mysql_wd[$weekday];
        $query = "SELECT ".parent::table_name().".*,
                         ".$this->db->dbprefix('calendar_item_types').".stream_id, ".$this->db->dbprefix('calendar_item_types').".admin_layout, ".$this->db->dbprefix('calendar_item_types').".public_layout,
                         ".$this->db->dbprefix('calendar_categories').".item_color
                  FROM ".parent::table_name()."
                  LEFT JOIN ".$this->db->dbprefix('calendar_item_types')." ON item_type = ".$this->db->dbprefix('calendar_item_types').".id
                  LEFT JOIN ".$this->db->dbprefix('calendar_categories')." ON category = ".$this->db->dbprefix('calendar_categories').".id
                  WHERE ((DATE_FORMAT(date_start, '%Y-%m-%d') = '".$year."-".$month."-".$day."' AND recurrence = 'once')
                  OR    (DATE_FORMAT(date_start, '%Y-%m') <= '".$year."-".$month."' AND recurrence = 'daily') 
                  OR    (WEEKDAY(date_start) = '".$weekday."' AND recurrence = 'weekly') 
                  OR    (DATE_FORMAT(date_start, '%Y-%d') <= '".$year."-".$day."' AND recurrence = 'monthly') 
                  OR    (DATE_FORMAT(date_start, '%m-%d') = '".$month."-".$day."' AND recurrence = 'annually' AND DATE_FORMAT(date_start, '%Y') <= '".$year."'))
                  ".($category != 'all' ? " AND category = '".$category."'" : '')."
                  ORDER BY DATE_FORMAT(date_start, '%T') ASC
                 ";
        
        $entries = $this->db->query($query)->result();
        
        if($entries)
        {
            if(isset($this->current_user->id))
            {
                $user_group = $this->current_user->group_id;
            }
            else
            {
                $user_group = 'guests';
            }
            
            foreach($entries as $key => &$entry)
            {
                $restrictions = $entry->restricted_to == null ? array() : @explode(',', $entry->restricted_to);
                
                if(!in_array('0', $restrictions) && !in_array($user_group, $restrictions))
                {
                    $entry->entry = $this->row_m->get_row($entry->stream_entry_id, $this->streams_m->get_stream($entry->stream_id), true);
                    $entry->author = $this->ion_auth->get_user($entry->created_by);
                    $restrictions = $entry->restricted_to == null ? array() : @explode(',', $entry->restricted_to);
                    $groups = array();
                    if($restrictions != null)
                    {
                        $this->load->model('groups/group_m');
                        foreach($restrictions as $key => $groupid)
                        {
                            if($groupid == 'guests')
                            {
                                $groups[] = 'Guests';
                            }
                            else if($groupid == '0')
                            {
                                $groups[] = '-- Any --';
                            }
                            else
                            {
                                $group = $this->group_m->get_by('id', $groupid);
                                $groups[] = $group->description;
                            }
                        }
                    }
                    $entry->restrictions = @implode(', ', $groups);
                }
            }
            
            return $entries;
        }
        
        return null;
    }
    
    public function get_upcoming_events($howmany, $categoryid)
    {
        $query = "SELECT ".parent::table_name().".*,
                         ".$this->db->dbprefix('calendar_item_types').".stream_id, ".$this->db->dbprefix('calendar_item_types').".admin_layout, ".$this->db->dbprefix('calendar_item_types').".public_layout,
                         ".$this->db->dbprefix('calendar_categories').".item_color
                  FROM ".parent::table_name()."
                  LEFT JOIN ".$this->db->dbprefix('calendar_item_types')." ON item_type = ".$this->db->dbprefix('calendar_item_types').".id
                  LEFT JOIN ".$this->db->dbprefix('calendar_categories')." ON category = ".$this->db->dbprefix('calendar_categories').".id
                  WHERE ((UNIX_TIMESTAMP(date_start) > '".time()."' AND recurrence = 'once')
                  OR    (recurrence IN ('daily', 'weekly', 'monthly', 'annually')))
                  ".($categoryid != 'all' ? " AND category = '".$categoryid."'" : '')."
                  ORDER BY DATE_FORMAT(date_start, '%Y-%m-%d') ASC, DATE_FORMAT(date_start, '%T') ASC
                 ";
        
        $entries = $this->db->query($query)->result();
        
        return $entries;
    }
    
    public function get_entry($id)
    {
        $query = "SELECT ".parent::table_name().".*,
                         ".$this->db->dbprefix('calendar_item_types').".stream_id, ".$this->db->dbprefix('calendar_item_types').".admin_layout, ".$this->db->dbprefix('calendar_item_types').".public_layout, ".$this->db->dbprefix('calendar_item_types').".public_layout_full,
                         ".$this->db->dbprefix('calendar_categories').".item_color, ".$this->db->dbprefix('calendar_categories').".name
                  FROM ".parent::table_name()."
                  LEFT JOIN ".$this->db->dbprefix('calendar_item_types')." ON item_type = ".$this->db->dbprefix('calendar_item_types').".id
                  LEFT JOIN ".$this->db->dbprefix('calendar_categories')." ON category = ".$this->db->dbprefix('calendar_categories').".id
                  WHERE ".parent::table_name().".id = '".$id."'
                 ";
        
        $entry = $this->db->query($query)->row();
        
        if($entry)
        {
            $entry->entry = $this->row_m->get_row($entry->stream_entry_id, $this->streams_m->get_stream($entry->stream_id), true);
            $entry->author = $this->ion_auth->get_user($entry->created_by);
            $restrictions = $entry->restricted_to == null ? array() : @explode(',', $entry->restricted_to);
            $groups = array();
            if($restrictions != null)
            {
                $this->load->model('groups/group_m');
                foreach($restrictions as $key => $groupid)
                {
                    if($groupid == 'guests')
                    {
                        $groups[] = 'Guests';
                    }
                    else if($groupid == '0')
                    {
                        $groups[] = '-- Any --';
                    }
                    else
                    {
                        $group = $this->group_m->get_by('id', $groupid);
                        $groups[] = $group->description;
                    }
                }
            }
            $entry->restrictions = @implode(', ', $groups);
            return $entry;
        }
        
        return null;
    }
    
    // -------------------------------------------------------------------------
    
    public function entries($start = null, $end = null, $categories = false)
    {
        if($start != null && $end != null)
        {
            $sql = "    SELECT ".parent::table_name().".*,
                        ".$this->db->dbprefix('calendar_item_types').".stream_id, ".$this->db->dbprefix('calendar_item_types').".admin_layout,
                        ".$this->db->dbprefix('calendar_categories').".item_color
                        FROM ".parent::table_name()."
                        LEFT JOIN ".$this->db->dbprefix('calendar_item_types')." ON item_type = ".$this->db->dbprefix('calendar_item_types').".id
                        LEFT JOIN ".$this->db->dbprefix('calendar_categories')." ON category = ".$this->db->dbprefix('calendar_categories').".id
                        WHERE (
                            (DATE_FORMAT(date_start, '%Y-%m-%d') >= '".date('Y-m-d', $start)."' AND DATE_FORMAT(date_end, '%Y-%m-%d') <= '".date('Y-m-d', $end)."' AND recurrence = 'once')
                        OR  (DATE_FORMAT(date_start, '%Y-%m-%d') <= '".date('Y-m-d', $end)."' AND recurrence <> 'once')
                        )
                        ".($categories !== false ? 'AND category IN (\''.@implode("', '", $categories).'\')' : '')."
                        ";
            return $this->db->query($sql)->result();
        }
        return null;
    }
}