<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['my_calendar'] = array(
    'day_type'          => 'long',
    'show_next_prev'    => true,
    'next_prev_url'     => site_url().'admin/calendar',
    'template'          => '
            {table_open}<table class="calendar">{/table_open}
            {week_day_cell}<th class="day_header">{week_day}</th>{/week_day_cell}
            {cal_cell_content}<span class="day_listing">{day}</span>{content}{/cal_cell_content}
            {cal_cell_content_today}<div class="today"><span class="day_listing">{day}</span>{content}</div>{/cal_cell_content_today}
            {cal_cell_no_content}<span class="day_listing">{day}</span>&nbsp;{/cal_cell_no_content}
            {cal_cell_no_content_today}<div class="today"><span class="day_listing">{day}</span></div>{/cal_cell_no_content_today}'
);