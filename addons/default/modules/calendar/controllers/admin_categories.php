<?php defined('BASEPATH') or exit('No direct script access allowed');

class Admin_categories extends Admin_Controller {
    
    protected $section = 'categories';
    
    private $validation_rules = array(
        'name' => array(
                'field' => 'category[name]',
                'label' => 'lang:calendar_label.name',
                'rules' => 'required|max_length[100]'
        ),
        'item_color' => array(
                'field' => 'category[item_color]',
                'label' => 'lang:calendar_label.item_color',
                'rules' => 'required|max_length[7]'
        )
    );
    
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('calendar');
        $this->load->model('calendar_categories_m');
    }
    
    public function index()
    {
        $categories = $this->calendar_categories_m->get_categories();
        
        $this->template
                ->set('categories', $categories)
                ->build('admin/categories/index');
    }
    
    public function create()
    {
        $this->form_validation->set_rules($this->validation_rules);
        
        if ($this->form_validation->run() !== false)
        {
            $category_data = $this->input->post('category');
            
            $category_id = $this->calendar_categories_m->insert($category_data);
            
            if($category_id > 0)
            {
                $this->session->set_flashdata('success', sprintf(lang('calendar_message.category_added'), $category_data['name']));
                redirect('admin/calendar/categories');
            }
            else
            {
                $this->session->set_flashdata('error', lang('calendar_message.category_failed_to_add'));
            }
        }
        
        $this->template
                ->append_js('module::jquery.miniColors.min.js')
                ->append_css('module::jquery.miniColors.css')
                ->append_js('module::form.Category.js')
                ->build('admin/categories/form');
        
    }
    
    public function edit($id = null)
    {
        if($id != null)
        {
            $category = $this->calendar_categories_m->get_category('id', $id);
            if($category)
            {
                
                $this->form_validation->set_rules($this->validation_rules);
                
                if($this->form_validation->run() == TRUE)
                {
                    $update_category = $this->input->post('category');
                    
                    if($this->calendar_categories_m->update_by('id', $category->id, $update_category))
                    {
                        $this->session->set_flashdata('success', sprintf(lang('calendar_message.category_updated'), $update_category['name']));
                        redirect('admin/calendar/categories');
                    }
                    else
                    {
                        $this->session->set_flashdata('error', lang('calendar_message.category_failed_to_update'));
                    }
                }

                $this->template
                        ->set('category_details', $category)
                        ->append_js('module::jquery.miniColors.min.js')
                        ->append_css('module::jquery.miniColors.css')
                        ->append_js('module::form.Category.js')
                        ->build('admin/categories/form');
            }
            else
            {
                $this->session->set_flashdata('error', lang('calendar_message.category_not_found'));
                redirect('admin/calendar/categories');
            }
        }
        else
        {
            $this->session->set_flashdata('error', lang('calendar_message.category_not_found'));
            redirect('admin/calendar/categories');
        }
    }
    
    public function delete($id = null)
    {
        if($id != null)
        {
            $category = $this->calendar_categories_m->get_category('id', $id);
            if($category)
            {
                if($category->total_items <= 0)
                {
                    if($this->calendar_categories_m->delete_by('id', $id))
                    {
                        $this->session->set_flashdata('success', sprintf(lang('calendar_message.category_deleted'), $category->name));
                        redirect('admin/calendar/categories');
                    }
                    else
                    {
                        $this->session->set_flashdata('error', sprintf(lang('calendar_message.category_failed_delete'), $category->name));
                        redirect('admin/calendar/categories');
                    }
                }
                else
                {
                    $this->session->set_flashdata('error', sprintf(lang('calendar_message.category_delete_has_items'), $category->name));
                    redirect('admin/calendar/categories');
                }
            }
            else
            {
                $this->session->set_flashdata('error', lang('calendar_message.category_not_found'));
                redirect('admin/calendar/categories');
            }
        }
        else
        {
            $this->session->set_flashdata('error', lang('calendar_message.category_not_found'));
            redirect('admin/calendar/categories');
        }
    }
    
}