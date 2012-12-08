<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once BASEPATH.'libraries/Calendar.php';

class Calendar_lib extends CI_Calendar {
    
    protected $ci;
    
    public function __construct()
    {
        parent::__construct();
        $this->ci =& get_instance();
        $this->ci->load->model('calendar/calendar_m');
    }
    
    public function public_view($year, $month, $category)
    {
        $adjusted_date = $this->adjust_date($month, $year);

        $month	= $adjusted_date['month'];
        $year	= $adjusted_date['year'];
        
        $data = $this->_build_public_data($year, $month, $category);

        // Determine the total days in the month
        $total_days = $this->get_total_days($month, $year);

        // Set the starting day of the week
        $start_days	= array('sunday' => 0, 'monday' => 1, 'tuesday' => 2, 'wednesday' => 3, 'thursday' => 4, 'friday' => 5, 'saturday' => 6);
        $start_day = ( ! isset($start_days[$this->start_day])) ? 0 : $start_days[$this->start_day];

        // Set the starting day number
        $local_date = mktime(12, 0, 0, $month, 1, $year);
        $date = getdate($local_date);
        $day  = $start_day + 1 - $date["wday"];

        while ($day > 1)
        {
            $day -= 7;
        }

        // Set the current month/year/day
        // We use this to determine the "today" date
        $cur_year	= date('Y', $this->local_time);
        $cur_month	= date('m', $this->local_time);
        $cur_day	= date('j', $this->local_time);

        $is_current_month = ($cur_year == $year AND $cur_month == $month) ? TRUE : FALSE;

        // Generate the template data array
        $this->parse_template();

        // Begin building the calendar output
        $out = $this->temp['table_open']."\n\n".$this->temp['heading_row_start']."\n";


        // Heading containing the month/year
        $colspan = ($this->show_next_prev == TRUE) ? 5 : 7;

        $this->temp['heading_title_cell'] = str_replace('{colspan}', $colspan,
                                                        str_replace('{heading}', $this->get_month_name($month).'&nbsp;'.$year, $this->temp['heading_title_cell']));

        $out .= $this->temp['heading_title_cell']."\n";

        $out .= "\n".$this->temp['heading_row_end']."\n\n"
                // Write the cells containing the days of the week
                .$this->temp['week_row_start']."\n";

        $day_names = $this->get_day_names();

        for ($i = 0; $i < 7; $i ++)
        {
            $out .= str_replace('{week_day}', $day_names[($start_day + $i) %7], $this->temp['week_day_cell']);
        }

        $out .= "\n".$this->temp['week_row_end']."\n";

        // Build the main body of the calendar
        while ($day <= $total_days)
        {
            $out .= "\n".$this->temp['cal_row_start']."\n";

            for ($i = 0; $i < 7; $i++)
            {
                $out .= ($is_current_month === TRUE AND $day == $cur_day) ? $this->temp['cal_cell_start_today'] : $this->temp['cal_cell_start'];

                if ($day > 0 AND $day <= $total_days)
                {
                    if (isset($data[$day]))
                    {
                            // Cells with content
                        $temp = ($is_current_month === TRUE AND $day == $cur_day) ?
                                        $this->temp['cal_cell_content_today'] : $this->temp['cal_cell_content'];
                        $out .= str_replace(array('{content}', '{day}'), array(count($data[$day]) == 1 ? site_url().'calendar/view/'.$category.'/'.$data[$day][0]['id'] : site_url().'calendar/'.$category.'/'.$year.'/'.$month.'/'.$day, $day), $temp);
                    }
                    else
                    {
                        // Cells with no content
                        $temp = ($is_current_month === TRUE AND $day == $cur_day) ?
                                        $this->temp['cal_cell_no_content_today'] : $this->temp['cal_cell_no_content'];
                        $out .= str_replace('{day}', $day, $temp);
                    }
                }
                else
                {
                        // Blank cells
                    $out .= $this->temp['cal_cell_blank'];
                }

                $out .= ($is_current_month === TRUE AND $day == $cur_day) ? $this->temp['cal_cell_end_today'] : $this->temp['cal_cell_end'];
                $day++;
            }

            $out .= "\n".$this->temp['cal_row_end']."\n";
        }

        $out .= "\n".$this->temp['table_close'];

        return $out;
    }
    
    public function admin_view($year, $month, $categoryid)
    {
        if ($year == null){
            $year  = date('Y', $this->local_time);
        } elseif (strlen($year) === 1){
            $year = '200'.$year;
        } elseif (strlen($year) === 2){
            $year = '20'.$year;
        }

        if ($month == null){
            $month = date('m', $this->local_time);
        } elseif (strlen($month) === 1) {
            $month = '0'.$month;
        }

        $adjusted_date = $this->adjust_date($month, $year);

        $month	= $adjusted_date['month'];
        $year	= $adjusted_date['year'];
        
        $data = $this->_build_admin_data($year, $month, $categoryid);

        // Determine the total days in the month
        $total_days = $this->get_total_days($month, $year);

        // Set the starting day of the week
        $start_days	= array('sunday' => 0, 'monday' => 1, 'tuesday' => 2, 'wednesday' => 3, 'thursday' => 4, 'friday' => 5, 'saturday' => 6);
        $start_day = ( ! isset($start_days[$this->start_day])) ? 0 : $start_days[$this->start_day];

        // Set the starting day number
        $local_date = mktime(12, 0, 0, intval($month), 1, intval($year));
        $date = getdate($local_date);
        $day  = $start_day + 1 - $date["wday"];

        while ($day > 1) {
                $day -= 7;
        }

        // Set the current month/year/day
        // We use this to determine the "today" date
        $cur_year	= date('Y', $this->local_time);
        $cur_month	= date('m', $this->local_time);
        $cur_day	= date('j', $this->local_time);

        $is_current_month = ($cur_year == $year AND $cur_month == $month) ? TRUE : FALSE;

        // Generate the template data array
        $this->parse_template();

        // Begin building the calendar output
        $out = $this->temp['table_open']."\n\n".$this->temp['heading_row_start']."\n";

        // "previous" month link
        if ($this->show_next_prev == TRUE)
        {
                // Add a trailing slash to the  URL if needed
            $this->next_prev_url = preg_replace("/(.+?)\/*$/", "\\1/",  $this->next_prev_url);

            $adjusted_date = $this->adjust_date($month - 1, $year);
            $out .= str_replace('{previous_url}', $this->next_prev_url.$adjusted_date['year'].'/'.$adjusted_date['month'], $this->temp['heading_previous_cell'])."\n";
        }

        // Heading containing the month/year
        $colspan = ($this->show_next_prev == TRUE) ? 5 : 7;

        $this->temp['heading_title_cell'] = str_replace('{colspan}', $colspan,
                                                        str_replace('{heading}', $this->get_month_name($month).'&nbsp;'.$year, $this->temp['heading_title_cell']));

        $out .= $this->temp['heading_title_cell']."\n";

        // "next" month link
        if ($this->show_next_prev == TRUE)
        {
            $adjusted_date = $this->adjust_date($month + 1, $year);
            $out .= str_replace('{next_url}', $this->next_prev_url.$adjusted_date['year'].'/'.$adjusted_date['month'], $this->temp['heading_next_cell']);
        }

        $out .= "\n".$this->temp['heading_row_end']."\n\n"
                // Write the cells containing the days of the week
                .$this->temp['week_row_start']."\n";

        $day_names = $this->get_day_names();

        for ($i = 0; $i < 7; $i ++)
        {
            $out .= str_replace('{week_day}', $day_names[($start_day + $i) %7], $this->temp['week_day_cell']);
        }

        $out .= "\n".$this->temp['week_row_end']."\n";

        // Build the main body of the calendar
        while ($day <= $total_days)
        {
                $out .= "\n".$this->temp['cal_row_start']."\n";

                for ($i = 0; $i < 7; $i++)
                {
                        $out .= ($is_current_month === TRUE AND $day == $cur_day) ? $this->temp['cal_cell_start_today'] : $this->temp['cal_cell_start'];

                        if ($day > 0 AND $day <= $total_days)
                        {
                                if (isset($data[$day]))
                                {
                                    if(is_array($data[$day])){
                                        $cell_cont = '';
                                        foreach($data[$day] as $key => $item){
                                            $cell_cont .= '<div class="item">'.$item.'</div>';
                                        }
                                        $temp = ($is_current_month === TRUE AND $day == $cur_day) ?
                                                        $this->temp['cal_cell_content_today'] : $this->temp['cal_cell_content'];
                                        $out .= str_replace(array('{content}', '{day}'), array($cell_cont, $day), $temp);
                                    } else {
                                        // Cells with content
                                        $temp = ($is_current_month === TRUE AND $day == $cur_day) ?
                                                        $this->temp['cal_cell_content_today'] : $this->temp['cal_cell_content'];
                                        $out .= str_replace(array('{content}', '{day}'), array('&nbsp;&bull; '.$data[$day], $day), $temp);
                                    }
                                }
                                else
                                {
                                        // Cells with no content
                                        $temp = ($is_current_month === TRUE AND $day == $cur_day) ?
                                                        $this->temp['cal_cell_no_content_today'] : $this->temp['cal_cell_no_content'];
                                        $out .= str_replace('{day}', $day, $temp);
                                }
                        }
                        else
                        {
                                // Blank cells
                                $out .= $this->temp['cal_cell_blank'];
                        }

                        $out .= ($is_current_month === TRUE AND $day == $cur_day) ? $this->temp['cal_cell_end_today'] : $this->temp['cal_cell_end'];
                        $day++;
                }

                $out .= "\n".$this->temp['cal_row_end']."\n";
        }

        $out .= "\n".$this->temp['table_close'];

        return $out;
    }
    
    private function _build_admin_data($year, $month, $categoryid)
    {
        $entries = $this->ci->calendar_m->get_entries($year, $month, $categoryid);

        $is_admin = false;
        
        if(isset($this->ci->current_user->id))
        {
            $user_group = $this->ci->current_user->group_id;
            if($this->ci->current_user->group == 'admin')
            {
                $is_admin = true;
            }
        }
        else
        {
            $user_group = 'guests';
        }

        $data = array();
        
        if($entries)
        {
            foreach($entries as $key => $entry)
            {
                $restrictions = $entry->restricted_to == null ? array() : @explode(',', $entry->restricted_to);

                if(!in_array('0', $restrictions) || $is_admin)
                {
                
                    if(in_array($user_group, $restrictions) || $is_admin) // Removed ! in !in_array()
                    {
                        $time = strtotime($entry->date_start);

                        switch ($entry->recurrence)
                        {
                            case 'daily':
                                if(date('Y', $time) <= $year && date('m', $time) < $month)
                                {
                                    $startday = 1;
                                }
                                else if(date('Y', $time) <= $year && date('m', $time) == $month)
                                {
                                    $startday = date('j', $time);
                                }
                                else
                                {
                                    $startday = 1;
                                }

                                for($i = $startday; $i <= 31; $i++)
                                {
                                    $data[$i][] = $this->__format_row($entry);
                                }
                                break;

                            case 'weekly':

                                $weekday = date('w', $time);

                                if(date('Y', $time) == $year && date('m', $time) == $month)
                                {
                                    $startday = date('j', $time);
                                }
                                else
                                {
                                    $year_time = mktime(23, 59, 59, $month, 1, $year);
                                    $cycle = 1;
                                    while(date('w', $year_time) != $weekday)
                                    {
                                        $cycle++;
                                        $year_time = mktime(23, 59, 59, $month, $cycle, $year);
                                    }
                                    $startday = date('j', $year_time);
                                }

                                while($startday <= 31)
                                {
                                    $data[$startday][] = $this->__format_row($entry);
                                    $startday += 7;
                                }

                                unset($day);
                                break;

                            case 'monthly':
                            case 'annually':
                            case 'once':
                                $data[(int)date('j', $time)][] = $this->__format_row($entry);
                                break;
                        }
                        unset($time);
                    }
                }
            }
        }
        
        return $data;
        
    }
    
    private function __format_row($entry)
    {
        $time = strtotime($entry->date_start);
        return '<div class="calendar-entry-row" style="background-color:'.$entry->item_color.';">&nbsp;</div>'.date('H:i', $time).' - '.$this->ci->parser->_parse($entry->admin_layout, get_object_vars($entry), true).' '.anchor('admin/calendar/view/'.$entry->id, Asset::img('module::edit.png', 'Edit'), 'class="view-entry-link"');
    }
    
    public function __format_row_public($entry)
    {
        $time = strtotime($entry->date_start);
        return array(
            'id'        => $entry->id,
            'out'       => $this->ci->parser->_parse($entry->public_layout, get_object_vars($entry), true)
        );
    }
    
    public function __format_entry($entry)
    {
        return $this->ci->parser->_parse($entry->public_layout_full, get_object_vars($entry), true);
    }
    
    private function _build_public_data($year, $month, $categoryid)
    {
        $entries = $this->ci->calendar_m->get_entries($year, $month, $categoryid);

        // Replaced with this to include admin
        $is_admin = false;

        if(isset($this->ci->current_user->id))
        {
            $user_group = $this->ci->current_user->group_id;
            if($this->ci->current_user->group == 'admin')
            {
                $is_admin = true;
            }
        }
        else
        {
            $user_group = 'guests';
        }

        $data = array();
        
        if($entries)
        {
            foreach($entries as $key => $entry)
            {
                $restrictions = $entry->restricted_to == null ? array() : @explode(',', $entry->restricted_to);

                if(!in_array('0', $restrictions))
                {
                
                    if(in_array($user_group, $restrictions) || $is_admin) // Removed ! in !in_array() & added $is_admin
                    {
                        $time = strtotime($entry->date_start);

                        switch ($entry->recurrence)
                        {
                            case 'daily':
                                if(date('Y', $time) <= $year && date('m', $time) < $month)
                                {
                                    $startday = 1;
                                }
                                else if(date('Y', $time) <= $year && date('m', $time) == $month)
                                {
                                    $startday = date('j', $time);
                                }
                                else
                                {
                                    $startday = 1;
                                }

                                for($i = $startday; $i <= 31; $i++)
                                {
                                    $data[$i][] = $this->__format_row_public($entry);
                                }
                                break;

                            case 'weekly':

                                $weekday = date('w', $time);

                                if(date('Y', $time) == $year && date('m', $time) == $month)
                                {
                                    $startday = date('j', $time);
                                }
                                else
                                {
                                    $year_time = mktime(23, 59, 59, $month, 1, $year);
                                    $cycle = 1;
                                    while(date('w', $year_time) != $weekday)
                                    {
                                        $cycle++;
                                        $year_time = mktime(23, 59, 59, $month, $cycle, $year);
                                    }
                                    $startday = date('j', $year_time);
                                }

                                while($startday <= 31)
                                {
                                    $data[$startday][] = $this->__format_row_public($entry);
                                    $startday += 7;
                                }

                                unset($day);
                                break;

                            case 'monthly':
                            case 'annually':
                            case 'once':
                                $data[(int)date('j', $time)][] = $this->__format_row_public($entry);
                                break;
                        }
                        unset($time);
                    }
                }
            }
        }
        
        return $data;
        
    }
    
    public function get_upcoming_events($howmany, $category)
    {
        $entries = $this->ci->calendar_m->get_upcoming_events($howmany, $category);
        
        $year   = date('Y');
        $month  = date('m');
        $day    = date('d');
        
        if($entries)
        {
            // Replaced with this to include admin
            $is_admin = false;

            if(isset($this->ci->current_user->id))
            {
                $user_group = $this->ci->current_user->group_id;
                if($this->ci->current_user->group == 'admin')
                {
                    $is_admin = true;
                }
            }
            else
            {
                $user_group = 'guests';
            }

            
            $out = array();
            
            foreach($entries as $key => $entry)
            {
                $restrictions = $entry->restricted_to == null ? array() : @explode(',', $entry->restricted_to);
                
                if(!in_array('0', $restrictions) && in_array($user_group, $restrictions) || $is_admin) // Removed ! in !in_array() & added $is_admin
                {
                    $entry->entry = $this->ci->row_m->get_row($entry->stream_entry_id, $this->ci->streams_m->get_stream($entry->stream_id), true);
                    $entry->formated = $this->__format_row_public($entry);
                    $time = strtotime($entry->date_start);

                    switch ($entry->recurrence)
                    {
                        case 'once':
                            $out = $this->__add_to_array($time, $entry, $out);
                            break;
                        
                        case 'daily':
                            for($i = 0; $i < 30; $i++)
                            {
                                $time = $time + $i * 60 * 60 * 24;
                                $out = $this->__add_to_array($time, $entry, $out);
                            }
                            break;
                            
                        case 'weekly':
                            for($i = 0; $i < 30; $i++)
                            {
                                $time = $time + $i * 60 * 60 * 24 * 7;
                                $out = $this->__add_to_array($time, $entry, $out);
                            }
                            break;
                            
                        case 'monthly':
                            for($i = 0; $i < 30; $i++)
                            {
                                $time = $time + $i * 60 * 60 * 24 * 30;
                                $out = $this->__add_to_array($time, $entry, $out);
                            }
                            break;
                            
                        case 'annually':
                            for($i = 0; $i < 30; $i++)
                            {
                                $time = $time + $i * 60 * 60 * 24 * 365;
                                $out = $this->__add_to_array($time, $entry, $out);
                            }
                            break;
                    }
                    unset($time);
                }

                ksort($out, SORT_NUMERIC);

                $out = array_slice($out, 0, $howmany, true);
//                if(count($out) == $howmany)
//                {
//                    return $out;
//                }
            }
            return $out;
        }
        else
        {
            return array();
        }
    }
    
    private function __add_to_array($key, $item, $array)
    {
        while(array_key_exists(intval($key), $array))
        {
            $key = intval($key) + 1;
        }
        $array[intval($key)] = $item;
        return $array;
    }
    
    // -------------------------------------------------------------------------
    // Functions for UI update release
    // -------------------------------------------------------------------------
    
    public function data_feed($_start, $_end, $categories)
    {
        $events = $this->ci->calendar_m->entries($_start, $_end, $categories);
        
        $this->ci->load->helper('date');
        
        if($events)
        {
            $output = array();
            
            $is_admin = false;

            if(isset($this->ci->current_user->id))
            {
                $user_group = $this->ci->current_user->group_id;
                if($this->ci->current_user->group == 'admin')
                {
                    $is_admin = true;
                }
            }
            else
            {
                $user_group = 'guests';
            }
            
            foreach($events as $key => $event)
            {
                $restrictions = $event->restricted_to == null ? array() : @explode(',', $event->restricted_to);
                
                if(!in_array('0', $restrictions) || $is_admin)
                {
                    if(in_array($user_group, $restrictions) || $is_admin)
                    {
                        switch ($event->recurrence)
                        {
                            case 'once':

                                    $output[] = $this->_format_feed_entry($event);

                                break;

                            case 'daily':

                                    $start_time = date('Y-m-d H:i:s', $_start) > $event->date_start ? $_start : strtotime($event->date_start);
                                    $_end_diff = strtotime($event->date_end) - strtotime($event->date_start);

                                    $diff_days = floor(($_end - $start_time) / 86400);

                                    $_event_start_time = date('H:i:s', strtotime($event->date_start));

                                    for($_i = 0; $_i <= $diff_days; $_i++)
                                    {
                                        $event->date_start = date('Y-m-d', $start_time + 86400 * $_i).' '.$_event_start_time;
                                        $event->date_end   = date('Y-m-d H:i:s', strtotime($event->date_start) + $_end_diff);
                                        $output[] = $this->_format_feed_entry($event);
                                    }

                                break;

                            case 'weekly':

                                    $start_time = date('Y-m-d H:i:s', $_start) > $event->date_start ? $_start : strtotime($event->date_start);
                                    $_end_diff = strtotime($event->date_end) - strtotime($event->date_start);

                                    $_week_day = date('w', strtotime($event->date_start));

                                    while(date('w', $start_time) != $_week_day)
                                    {
                                        $start_time += 86400;
                                    }

                                    $diff_weeks = floor(($_end - $start_time) / 604800);

                                    $_event_start_time = date('H:i:s', strtotime($event->date_start));

                                    for($_i = 0; $_i <= $diff_weeks; $_i++)
                                    {
                                        $event->date_start = date('Y-m-d', $start_time + 604800 * $_i).' '.$_event_start_time;
                                        $event->date_end   = date('Y-m-d H:i:s', strtotime($event->date_start) + $_end_diff);
                                        $output[] = $this->_format_feed_entry($event);
                                    }

                                break;

                            case 'monthly':

                                    $start_time = date('Y-m-d H:i:s', $_start) > $event->date_start ? $_start : strtotime($event->date_start);
                                    $_end_diff = strtotime($event->date_end) - strtotime($event->date_start);

                                    $diff_months = date('n', $_end) - date('n', $start_time);
                                    $diff_years  = date('Y', $_end) - date('Y', $start_time);

                                    $_event_start_time = strtotime($event->date_start);

                                    $_start_point = $start_time;

                                    for($_i = 0; $_i <= 2; $_i++)
                                    {
                                        $event->date_start = date('Y-m-d H:i:s', mktime(date('H', $_event_start_time), date('i', $_event_start_time), date('s', $_event_start_time), date('n', $start_time) + $_i, date('d', $_event_start_time), date('Y', $start_time)));
                                        $event->date_end   = date('Y-m-d H:i:s', strtotime($event->date_start) + $_end_diff);
                                        $output[] = $this->_format_feed_entry($event);
                                    }

                                break;

                            case 'annually':

                                    $start_time = date('Y-m-d H:i:s', $_start) > $event->date_start ? $_start : strtotime($event->date_start);
                                    $_end_diff = strtotime($event->date_end) - strtotime($event->date_start);

                                    $diff_years = date('Y', $_end) - date('Y', $start_time);

                                    for($_i = 0; $_i <= $diff_years; $_i++)
                                    {
                                        if(($_start <= strtotime((date('Y', $start_time) + $_i).date('-m-d H:i:s', strtotime($event->date_start)))
                                           && strtotime((date('Y', $start_time) + $_i).date('-m-d H:i:s', strtotime($event->date_start))) <= $_end)
                                           ||
                                           ($_start <= strtotime((date('Y', $start_time) + $_i).date('-m-d H:i:s', strtotime($event->date_start))) + $_end_diff
                                           && strtotime((date('Y', $start_time) + $_i).date('-m-d H:i:s', strtotime($event->date_start))) + $_end_diff <= $_end))
                                        {
                                            $event->date_start = (date('Y', $start_time) + $_i).date('-m-d H:i:s', strtotime($event->date_start));
                                            $event->date_end   = date('Y-m-d H:i:s', strtotime($event->date_start) + $_end_diff);
                                            $output[] = $this->_format_feed_entry($event);
                                        }
                                    }

                                break;
                        }
                    }
                }
            }
            
        }
        
        return isset($output) && count($output) > 0 ? $output : array(false);
    }
    
    private function _format_feed_entry($event)
    {
        $event->entry = $this->ci->row_m->get_row($event->stream_entry_id, $this->ci->streams_m->get_stream($event->stream_id), true);
        $event->author = $this->ci->ion_auth->get_user($event->created_by);
        $restrictions = $event->restricted_to == null ? array() : @explode(',', $event->restricted_to);
        $groups = array();
        if($restrictions != null)
        {
            $this->ci->load->model('groups/group_m');
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
                    $group = $this->ci->group_m->get_by('id', $groupid);
                    $groups[] = $group->description;
                }
            }
        }
        $event->restrictions = @implode(', ', $groups);
        return array(
            'id'                => $event->id,
            'title'             => $this->ci->parser->_parse($event->admin_layout, get_object_vars($event), true),
            'start'             => date('c', strtotime($event->date_start)),
            'end'               => date('c', strtotime($event->date_end)),
            'backgroundColor'   => $event->item_color,
            'allDay'            => false
        );
    }
}