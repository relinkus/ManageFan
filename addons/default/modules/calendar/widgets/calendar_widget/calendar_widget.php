<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Widget_Calendar_widget extends Widgets {
    
    public $title       = 'Calendar widget';
    public $description = 'Display calendar on your website.';
    public $author      = 'Edvinas Krucas';
    public $website     = '';
    public $version     = '1.0';
    
    public $fields      = array(
        array(
            'field'         => 'category',
            'label'         => 'lang:calendar_label.category',
            'rules'         => 'required'
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
//        $this->load->library('calendar/my_calendar');
        
//        $this->get_p
        
        $this->load->library('calendar/calendar_lib');
        
        $config['template'] = '
            {table_open}<table class="calendar_box">{/table_open}
            {week_day_cell}<th class="day_header">{week_day}</th>{/week_day_cell}
            {cal_cell_content}<a class="calendar-tooltip" href="{content}"><strong>{day}</strong>{/cal_cell_content}
            {cal_cell_content_today}<div class="today"><a class="calendar-tooltip" href="{content}"><strong>{day}</strong>{/cal_cell_content_today}
            {cal_cell_no_content}{day}{/cal_cell_no_content}
            {cal_cell_no_content_today}<div class="today">{day}</div>{/cal_cell_no_content_today}
            {cal_cell_start_today}<td class="today">{/cal_cell_start_today}';
        
        $this->calendar_lib->initialize($config);
        
        $year   = date('Y');
        $month  = date('m');

        return array(
            'year'      => $year,
            'month'     => $month,
            'category'  => $options['category']
        );
    }
    
}