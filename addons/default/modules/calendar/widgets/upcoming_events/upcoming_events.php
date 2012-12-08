<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Widget_Upcoming_events extends Widgets {
    
    public $title       = 'Upcoming events';
    public $description = 'Display upcoming events from calendar.';
    public $author      = 'Edvinas Krucas';
    public $website     = '';
    public $version     = '1.0';
    
    public $fields      = array(
        array(
            'field'         => 'category',
            'label'         => 'lang:calendar_label.category',
            'rules'         => 'required'
        ),
        array(
            'field'         => 'howmany',
            'label'         => 'lang:calendar_label.howmany',
            'rules'         => 'required|integer'
        )
    );
    
    public function __construct()
    {
        $this->lang->load('calendar/calendar');
    }
    
    public function form($options)
    {
        $this->load->model('calendar/calendar_categories_m');
        
        $categories = $this->calendar_categories_m->get_categories();
        
        $categories_dropdown = array();
        
        $categories_dropdown['all'] = lang('global:select-all');
        
        if($categories)
        {
            foreach($categories as $key => $category)
            {
                $categories_dropdown[$category->id] = $category->name;
            }
        }
        
        return array(
            'options'       => $options,
            'categories'    => $categories_dropdown
        );
    }
    
    public function run($options)
    {
        $this->load->library('calendar/calendar_lib');
        $entries = $this->calendar_lib->get_upcoming_events($options['howmany'], $options['category']);
        return array(
            'entries'       => $entries,
            'category'      => $options['category'],
            'howmany'       => $options['howmany']
        );
    }
    
}