<?php defined('BASEPATH') or exit('No direct script access allowed');

class Admin_types extends Admin_Controller {
    
    protected $section = 'item_types';
    
    private $validation_rules = array(
        'name' => array(
                'field' => 'type[name]',
                'label' => 'lang:calendar_label.name',
                'rules' => 'required|max_length[60]'
        ),
        'slug' => array(
                'field' => 'type[slug]',
                'label' => 'lang:calendar_label.slug',
                'rules' => 'required|max_length[56]|streams_slug_safe'
        ),
        'about' => array(
                'field' => 'type[about]',
                'label' => 'lang:calendar_label.about',
                'rules' => ''
        ),
        'admin_layout' => array(
                'field' => 'type[admin_layout]',
                'label' => 'lang:calendar_label.admin_layout',
                'rules' => 'required'
        ),
        'public_layout' => array(
                'field' => 'type[public_layout]',
                'label' => 'lang:calendar_label.public_layout',
                'rules' => 'required'
        ),
        'public_layout_full' => array(
                'field' => 'type[public_layout_full]',
                'label' => 'lang:calendar_label.public_layout_full',
                'rules' => 'required'
        )
    );
    
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('calendar');
        $this->load->model('calendar_item_types_m');
    }
    
    public function index()
    {
        $item_types = $this->calendar_item_types_m->get_types();

        $this->template
                ->set('item_types', $item_types)
                ->build('admin/item_types/index');
    }
    
    public function create()
    {
        $this->form_validation->set_rules($this->validation_rules);
        
        if ($this->form_validation->run() !== false)
        {
            $type_data = $this->input->post('type');
            
            if($this->streams->streams->add_stream($type_data['name'], 'c_i_'.$type_data['slug'], 'c_i_'.$type_data['slug'].'_ns', null, $type_data['about']))
            {
                $inserted_stream = $this->streams->streams->get_stream('c_i_'.$type_data['slug'], 'c_i_'.$type_data['slug'].'_ns');
                
                $type_id = $this->calendar_item_types_m->insert(array(
                    'stream_id'             => $inserted_stream->id,
                    'admin_layout'          => $type_data['admin_layout'],
                    'public_layout'         => $type_data['public_layout'],
                    'public_layout_full'    => $type_data['public_layout_full']
                ));
                
                if($type_id > 0)
                {
                    $this->session->set_flashdata('success', sprintf(lang('calendar_message.item_type_added'), $type_data['name']));
                    redirect('admin/calendar/types');
                }
                else
                {
                    $this->streams->streams->delete_stream($inserted_stream->stream_slug, $inserted_stream->stream_namespace);
                    $this->session->set_flashdata('error', lang('calendar_message.item_type_failed_to_add'));
                }
                
            }
            else
            {
                $this->session->set_flashdata('error', lang('calendar_message.item_type_failed_to_add'));
            }
        }
        
        $this->template
                ->append_js('module::form.ItemType.js')
                ->build('admin/item_types/type_form');
        
    }
    
    public function edit($id = null)
    {
        if($id != null)
        {
            $item_type = $this->calendar_item_types_m->get_type('calendar_item_types.id', $id);

            if($item_type)
            {
                unset($this->validation_rules['slug']);
                
                $this->form_validation->set_rules($this->validation_rules);

                if ($this->form_validation->run() !== false)
                {
                    $type_data = $this->input->post('type');

                    $update_data = array(
                        'stream_name'       => $type_data['name'],
                        'about'             => $type_data['about']
                    );

                    if($this->streams->streams->update_stream($item_type->stream_slug, $item_type->stream_namespace, $update_data))
                    {
                        $this->calendar_item_types_m->update_by('id', $id, array(
                            'admin_layout'          => $type_data['admin_layout'],
                            'public_layout'         => $type_data['public_layout'],
                            'public_layout_full'    => $type_data['public_layout_full']
                        ));
                        $this->session->set_flashdata('success', sprintf(lang('calendar_message.item_type_updated'), $type_data['name']));
                        redirect('admin/calendar/types');
                    }
                    else
                    {
                        $this->session->set_flashdata('error', lang('calendar_message.item_type_failed_to_update'));
                    }
                }

                $this->template
                        ->set('item_type', $item_type)
                        ->append_js('module::form.ItemType.js')
                        ->build('admin/item_types/type_form');
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
    
    public function delete($id = null)
    {
        if($id != null)
        {
            $item_type = $this->calendar_item_types_m->get_type('calendar_item_types.id', $id);

            if($item_type)
            {
                if($this->streams->streams->get_stream($item_type->stream_slug, $item_type->stream_namespace))
                {
                    $stream_fields  = $this->streams_m->get_stream_fields($item_type->stream_id);

                    if($stream_fields != false)
                    {
                        foreach($stream_fields as $key => $field)
                        {
                            $this->streams->fields->delete_field($field->field_slug, $field->field_namespace);
                        }
                    }

                    $this->calendar_item_types_m->delete_by('id', $id);
                    
                    $this->streams->streams->delete_stream($item_type->stream_slug, $item_type->stream_namespace);
                    
                    $this->session->set_flashdata('success', lang('calendar_message.item_type_deleted'));
                    redirect('admin/calendar/types');
                }
                else
                {
                    $this->session->set_flashdata('error', lang('calendar_message.item_type_failed_to_delete'));
                    redirect('admin/calendar/types');
                }
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
    
    public function fields($id = null)
    {
        if($id != null)
        {
            $item_type = $this->calendar_item_types_m->get_type('calendar_item_types.id', $id);

            if($item_type)
            {
                $extra['title'] = $item_type->stream_name.' &rarr; '.lang('calendar_title.fields');
                $extra['buttons'] = array(
                    array(
                        'url'		=> 'admin/calendar/types/editfield/'.$id.'/-assign_id-', 
                        'label'		=> $this->lang->line('global:edit')
                    ),
                    array(
                        'url'		=> 'admin/calendar/types/deletefield/'.$id.'/-assign_id-',
                        'label'		=> $this->lang->line('global:delete'),
                        'confirm'	=> true
                    )
                );

                $this->streams->cp->assignments_table($item_type->stream_slug,
                                                    $item_type->stream_namespace,
                                                    $this->settings->get('records_per_page'),
                                                    'admin/calendar/fields/'.$id.'/',
                                                    true,
                                                    $extra);
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
    
    public function newfield($id = null)
    {
        if($id != null)
        {
            $item_type = $this->calendar_item_types_m->get_type('calendar_item_types.id', $id);
            
            if($item_type)
            {
                $extra['title'] = $item_type->stream_name.' &rarr; '.lang('streams.new_field');
                $this->streams->cp->field_form($item_type->stream_slug, $item_type->stream_namespace, 'new', 'admin/calendar/types/fields/'.$id, null, array(), true, $extra);
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
    
    public function editfield($id = null, $fid)
    {
        if($id != null)
        {
            $item_type = $this->calendar_item_types_m->get_type('calendar_item_types.id', $id);
            
            if($item_type)
            {
                $extra['title'] = $item_type->stream_name.' &rarr; '.lang('streams.edit_field');
                $this->streams->cp->field_form($item_type->stream_slug, $item_type->stream_namespace, 'edit', 'admin/calendar/types/fields/'.$id, $fid, array(), true, $extra);
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
    
    
    public function deletefield($id = null, $fid)
    {
        if($id != null)
        {
            $item_type = $this->calendar_item_types_m->get_type('calendar_item_types.id', $id);
            
            if($item_type)
            {
                if(!$this->streams->cp->teardown_assignment_field($fid))
                {
                    $this->session->set_flashdata('notice', lang('calendar_message.field_failed_to_delete'));
                }
                else
                {
                    $this->session->set_flashdata('success', lang('calendar_message.field_deleted'));			
                }
                redirect('admin/calendar/types/fields/'.$id);
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
}