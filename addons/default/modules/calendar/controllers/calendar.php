<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends Public_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('calendar_lib');
    }
    
    public function index($categoryid = null, $year = null, $month = null, $day = null)
    {
        if($year == 'today' || $year == null)
        {
            $year   = date('Y');
            $month  = date('m');
            $day    = date('d');
        }
        
        if($categoryid == null)
        {
            $entries = null;
        }
        else
        {
            $entries = $this->calendar_m->get_day_entries($year, $month, $day, $categoryid);
        }
        
        $this->template
                ->set_breadcrumb(lang('calendar_title.calendar'), 'calendar/'.$categoryid)
                ->set_breadcrumb($day.' '.$this->calendar_lib->get_month_name($month).', '.$year)
                ->set('entries', $entries)
                ->set('categoryid', $categoryid)
                ->build('public/entries');
    }
    
    public function view($categoryid = null, $id = null)
    {
        if($id != null && $categoryid != null){
            $entry = $this->calendar_m->get_entry($id);
            if($entry){
                
                // Replaced with this to include admin
                $is_admin = false;

                if(isset($this->current_user->id))
                {
                    $user_group = $this->current_user->group_id;
                    if($this->current_user->group == 'admin')
                    {
                        $is_admin = true;
                    }
                }
                else
                {
                    $user_group = 'guests';
                }


                $restrictions = $entry->restricted_to == null ? array() : @explode(',', $entry->restricted_to);
                
                if(!in_array('0', $restrictions) && in_array($user_group, $restrictions) || $is_admin)
                {
                    $year   = date('Y', strtotime($entry->date_start));
                    $month  = date('m', strtotime($entry->date_start));
                    $day    = date('d', strtotime($entry->date_start));

                    $formated_title = $this->calendar_lib->__format_row_public($entry);

                    $this->template
                            ->set_breadcrumb(lang('calendar_title.calendar'), 'calendar/'.$categoryid)
                            ->set_breadcrumb($formated_title['out'])
                            ->set('formated_entry', $this->calendar_lib->__format_entry($entry))
                            ->build('public/details');
                }
                else
                {
                    $this->session->set_flashdata('error', lang('calendar_message.entry_not_found'));
                    redirect('calendar');
                }
            } else {
                $this->session->set_flashdata('error', lang('calendar_message.entry_not_found'));
                redirect('calendar');
            }
        } else {
            $this->session->set_flashdata('error', lang('calendar_message.entry_not_found'));
            redirect('calendar');
        }
    }
    
}