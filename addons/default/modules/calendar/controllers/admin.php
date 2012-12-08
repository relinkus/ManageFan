<?php defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends Admin_Controller {
    
    protected $section = 'calendar';
    
    private $validation_rules = array(
        'date_start_date' => array(
                'field' => 'basic_data[date_start][date]',
                'label' => 'lang:calendar_label.date_start',
                'rules' => 'required|max_length[10]'
        ),
        'date_start_hour' => array(
                'field' => 'basic_data[date_start][hour]',
                'label' => 'lang:calendar_label.date_start',
                'rules' => 'required'
        ),
        'date_start_minute' => array(
                'field' => 'basic_data[date_start][minute]',
                'label' => 'lang:calendar_label.date_start',
                'rules' => 'required'
        ),
        'date_end_date' => array(
                'field' => 'basic_data[date_end][date]',
                'label' => 'lang:calendar_label.date_end',
                'rules' => 'required|max_length[10]'
        ),
        'date_end_hour' => array(
                'field' => 'basic_data[date_end][hour]',
                'label' => 'lang:calendar_label.date_end',
                'rules' => 'required'
        ),
        'date_end_minute' => array(
                'field' => 'basic_data[date_end][minute]',
                'label' => 'lang:calendar_label.date_end',
                'rules' => 'required'
        ),
        'category' => array(
                'field' => 'basic_data[category]',
                'label' => 'lang:calendar_label.category',
                'rules' => 'required'
        ),
        'recurrence' => array(
                'field' => 'basic_data[recurrence]',
                'label' => 'lang:calendar_label.recurrence',
                'rules' => 'required'
        ),
        'restricted_to' => array(
                'field' => 'basic_data[restricted_to]',
                'label' => 'lang:calendar_label.restricted_to',
                'rules' => ''
        ),
    );
    
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('calendar');
        $this->load->library('calendar_lib');
        $this->load->model('calendar_m');
    }
    
    public function index()
    {
        $this->load->model('calendar_categories_m');
        $this->template
                ->append_css('module::calendar.css')
                ->append_css('module::fullcalendar.css')
                ->append_css('module::theme.css')
                ->append_js('module::fullcalendar.min.js')
                ->append_js('module::calendar.init.js')
                ->set('categories', $this->calendar_categories_m->get_categories())
                ->build('admin/calendar/calendar');
    }
    
    public function data_feed()
    {
        $_start     = $this->input->get('start');
        $_end       = $this->input->get('end');
        $categories = $this->input->get('categories');

        echo json_encode($this->calendar_lib->data_feed($_start, $_end, $categories));
    }
    
    public function ajax()
    {
        $action     = $this->input->post('action');
        $event_id   = $this->input->post('event_id');
        
        $event = $this->calendar_m->get_entry($event_id);
        
        $status = false;
        
        if($event)
        {
            switch($action)
            {
                case 'drop':

                        $day_delta          = $this->input->post('day_delta');
                        $minute_delta       = $this->input->post('minute_delta');
                        
                        $_start_time        = strtotime($event->date_start);
                        $_end_time          = strtotime($event->date_end);
                        
                        $_time_diff         = $_end_time - $_start_time;
                        
                        $_new_start_date    = mktime(date('H', $_start_time), date('i', $_start_time) + $minute_delta, date('s', $_start_time), date('n', $_start_time), date('d', $_start_time) + $day_delta, date('Y', $_start_time));
                        
                        if($_new_start_date <= $_new_start_date + $_time_diff)
                        {
                            if($this->calendar_m->update_by('id', $event->id, array(
                                'date_start'            => date('Y-m-d H:i:s', $_new_start_date),
                                'date_end'              => date('Y-m-d H:i:s', $_new_start_date + $_time_diff)
                            )))
                            {
                                $status = true;
                            }
                        }
                        
                    break;
                    
                case 'resize':

                        $day_delta          = $this->input->post('day_delta');
                        $minute_delta       = $this->input->post('minute_delta');
                        
                        $_start_time        = strtotime($event->date_start);
                        $_end_time          = strtotime($event->date_end);
                        
                        $_time_diff         = $_end_time - $_start_time;
                        
                        $_new_end_date      = mktime(date('H', $_end_time), date('i', $_end_time) + $minute_delta, date('s', $_end_time), date('n', $_end_time), date('d', $_end_time) + $day_delta, date('Y', $_end_time));
                        
                        
                        if($_start_time <= $_new_end_date)
                        {
                            if($this->calendar_m->update_by('id', $event->id, array(
    //                            'date_start'            => date('Y-m-d H:i:s', $_new_start_date),
                                'date_end'              => date('Y-m-d H:i:s', $_new_end_date)
                            )))
                            {
                                $status = true;
                            }
                        }
                        
                    break;
            }
        }
        
        echo json_encode(array('status' => $status));
    }
    
    public function view($id = null)
    {
        if($id != null)
        {
            $entry = $this->calendar_m->get_entry($id);
            if($entry)
            {
                $stream = $this->streams_m->get_stream($entry->stream_id);
                $fields = $this->fields_m->get_assignments_for_stream($entry->stream_id);
                
                $entry->restricted_to = $entry->restricted_to == null ? array() : @explode(',', $entry->restricted_to);
                
                
                $this->load->model('groups/group_m');
                $groups = $this->group_m->get_all();
                $restrictions = array();
                
                if(in_array('guests', $entry->restricted_to))
                {
                    $restrictions[] = lang('calendar_label.guests');
                }
                
                foreach($groups as $group)
                {
                    if(in_array($group->id, $entry->restricted_to))
                    {
                        $restrictions[] = $group->description;
                    }
                }

                if(in_array('0', $entry->restricted_to))
                {
                    $entry->restricted_to = lang('global:select-any');
                }
                else
                {
                    if(count($restrictions) > 0)
                    {
                        $entry->restricted_to = implode(', ', $restrictions);
                    }
                    else
                    {
                        $entry->restricted_to = '-';
                    }
                }
                
                $this->template
                        ->set('stream', $stream)
                        ->set('entry', $entry)
                        ->set('fields', $fields)
                        ->build('admin/calendar/view_entry');
            }
            else
            {
                $this->session->set_flashdata('error', lang('calendar_message.entry_not_found'));
                redirect('admin/calendar');
            }
        }
        else
        {
            $this->session->set_flashdata('error', lang('calendar_message.entry_not_found'));
            redirect('admin/calendar');
        }
    }
    
    public function delete($id = null)
    {
        if($id != null)
        {
            $entry = $this->calendar_m->get_entry($id);
            if($entry)
            {
                $stream = $this->streams_m->get_stream($entry->stream_id);
                if($this->calendar_m->delete_by('id', $id) && $this->streams->entries->delete_entry($entry->entry->id, $stream->stream_slug, $stream->stream_namespace))
                {
                    $this->session->set_flashdata('success', lang('calendar_message.entry_deleted'));
                    redirect('admin/calendar');
                }
                else
                {
                    $this->session->set_flashdata('error', lang('calendar_message.entry_failed_to_delete'));
                    redirect('admin/calendar');
                }
            }
            else
            {
                $this->session->set_flashdata('error', lang('calendar_message.entry_not_found'));
                redirect('admin/calendar');
            }
        }
        else
        {
            $this->session->set_flashdata('error', lang('calendar_message.entry_not_found'));
            redirect('admin/calendar');
        }
    }
    
    public function create($type_id = null)
    {
        if($type_id != null)
        {
            $this->load->model('calendar_item_types_m');

            $type = $this->calendar_item_types_m->get_type('calendar_item_types.id', $type_id);
            
            
            if($type)
            {
                $this->load->library(array('form_validation', 'streams_core/Fields'));
                
                $stream = $this->streams->streams->get_stream($type->stream_slug, $type->stream_namespace);
                
                $this->form_validation->set_rules($this->validation_rules);
                
                $this->_entry_form($stream, 'new', null);
                
                $restricted_to = array();
                $post_restrictions = $this->input->post('basic_data');
                if(isset($post_restrictions['restricted_to']))
                {
                    $restricted_to = $post_restrictions['restricted_to'];
                }
                
                $this->_form_data();
                $this->template
                        ->set('type', $type)
                        ->set('restricted_to', $restricted_to)
                        ->append_js('streams/entry_form.js')
                        ->append_js('module::form.Entry.js')
                        ->build('admin/calendar/form');
            }
            else
            {
                $this->session->set_flashdata('error', lang('calendar_message.item_type_not_found'));
                redirect('admin/calendar/types');
            }
        }
        else
        {
            $this->session->set_flashdata('error', lang('calendar_message.item_type_not_found'));
            redirect('admin/calendar/types');
        }
    }
    
    public function edit($id = null)
    {
        if($id != null)
        {
            $entry = $this->calendar_m->get_entry($id);
            if($entry)
            {
                $_date_start = strtotime($entry->date_start);
                $_date_end   = strtotime($entry->date_end);
                
                $entry->_date_start->date   = date('Y-m-d', $_date_start);
                $entry->_date_start->hour   = date('H', $_date_start);
                $entry->_date_start->minute = date('i', $_date_start);
                
                $entry->_date_end->date   = date('Y-m-d', $_date_end);
                $entry->_date_end->hour   = date('H', $_date_end);
                $entry->_date_end->minute = date('i', $_date_end);
                
                $this->load->model('calendar_item_types_m');
                $type = $this->calendar_item_types_m->get_type('calendar_item_types.id', $entry->item_type);
                
                $this->load->library(array('form_validation', 'streams_core/Fields'));
                
                $stream = $this->streams->streams->get_stream($type->stream_slug, $type->stream_namespace);
                
                $this->form_validation->set_rules($this->validation_rules);
                
                $restricted_to = $entry->restricted_to == null ? array() : @explode(',', $entry->restricted_to);
                $post_restrictions = $this->input->post('basic_data');
                if($post_restrictions)
                {
                    if(isset($post_restrictions['restricted_to']))
                    {
                        $restricted_to = $post_restrictions['restricted_to'];
                    }
                    else
                    {
                        $restricted_to = array();
                    }
                }
                
                
                $this->_entry_form($stream, 'edit', $entry->entry->id);
                
                $this->_form_data();
                $this->template
                        ->set('type', $type)
                        ->set('entry', $entry)
                        ->set('restricted_to', $restricted_to)
                        ->append_js('streams/entry_form.js')
                        ->append_js('module::form.Entry.js')
                        ->build('admin/calendar/form');
            }
            else
            {
                $this->session->set_flashdata('error', lang('calendar_message.entry_not_found'));
                redirect('admin/calendar');
            }
        }
        else
        {
            $this->session->set_flashdata('error', lang('calendar_message.entry_not_found'));
            redirect('admin/calendar');
        }
    }
    
    private function _entry_form($stream, $mode, $entryid)
    {
        
        if($mode == 'edit')
        {
            $entry = $this->row_m->get_row($entryid, $stream, false);
        }
        else
        {
            $entry = null;
        }
        
        $this->load->helper(array('form', 'url'));
        
        $this->load->language('streams_core/pyrostreams');
        
        $stream_fields = $this->streams_m->get_stream_fields($stream->id);
        
        if ($stream_fields === false) return false;
        
        $events_called = $this->fields->run_field_events($stream_fields, array());
        
        $row_id = ($mode == 'edit') ? $entry->id : null;
        
        $this->fields->set_rules($stream_fields, $mode, array(), false, $row_id);
        
        $values = $this->fields->set_values($stream_fields, $entry, $mode, array());
        
        $result_id = '';

        if ($this->form_validation->run() === TRUE)
        {
            if ($mode == 'new')
            {
                if ( ! $result_id = $this->row_m->insert_entry($_POST, $stream_fields, $stream, array()))
                {
                    $this->session->set_flashdata('notice', lang('calendar_message.calendar_entry_failed_to_add'));
                }
                else
                {
                    $this->calendar_m->insert_entry($this->input->post('basic_data'), $result_id);
                    $this->session->set_flashdata('success', lang('calendar_message.calendar_entry_added'));
                }
            }
            else
            {
                if ( ! $result_id = $this->row_m->update_entry(
                                                                                        $stream_fields,
                                                                                        $stream,
                                                                                        $entry->id,
                                                                                        $this->input->post(),
                                                                                        array()
                                                                                ))
                {
                    $this->session->set_flashdata('notice', lang('calendar_message.calendar_entry_failed_to_update'));	
                }
                else
                {
                    $this->calendar_m->update_entry($this->uri->segment(4), $this->input->post('basic_data'), $result_id);
                    $this->session->set_flashdata('success', lang('calendar_message.calendar_entry_updated'));
                }
            }

            redirect('admin/calendar');
        }
        
        $this->template->set('fields', $this->fields->build_fields($stream_fields, $values, $entry, $mode, array()));
        
    }
    
    private function _form_data()
    {
        $this->load->model('groups/group_m');
        $groups = $this->group_m->get_all();
        foreach ($groups as $group)
        {
                $group->name !== 'admin' && $group_options[$group->id] = $group->description;
        }
        $this->template->group_options = $group_options;
        
        // lets load our categories
        $this->load->model('calendar_categories_m');
        
        $categories = $this->calendar_categories_m->get_categories();
        
        $categories_dropdown = array();
        
        if($categories)
        {
            foreach($categories as $key => $category)
            {
                $categories_dropdown[$category->id] = $category->name;
            }
        }
        else
        {
            $categories_dropdown = lang('calendar_message.create_category_first');
        }
        
        $this->template->calendar_categories = $categories_dropdown;
        
        // lets generate other data too
        
        $hours = array();
        
        for($i = 0; $i < 24; $i++)
        {
            $hours[sprintf('%1$02d', $i)] = sprintf('%1$02d', $i);
        }
        
        $this->template->hours = $hours;
        
        $minutes = array();
        
        for($i = 0; $i < 60; $i++)
        {
            $minutes[sprintf('%1$02d', $i)] = sprintf('%1$02d', $i);
        }
        
        $this->template->minutes = $minutes;
        
        $this->template->recurrence = array(
            'once'          => lang('calendar_label.recurrence.once'),
            'daily'         => lang('calendar_label.recurrence.daily'),
            'weekly'        => lang('calendar_label.recurrence.weekly'),
            'monthly'       => lang('calendar_label.recurrence.monthly'),
            'annually'      => lang('calendar_label.recurrence.annually')
        );
    }
    
}