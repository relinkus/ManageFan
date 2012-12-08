<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Calendar extends Module {

    public $version = '2.1.0';
    
    private $event_columns = array(
     		'title' => array(
                    'field' => array(
                        'slug'              => 'title',
    			'name'              => 'Title',
                        'namespace'         => 'c_i_events_list_ns',
    			'type'              => 'text',
    			'extra'             => array('max_length' => 100),
                        'assign'            => 'c_i_events_list',
                        'title_column'      => true,
                        'required'          => true
                    )
    		),
     		'description' => array(
                    'field' => array(
                        'slug'              => 'description',
    			'name'              => 'Description',
                        'namespace'         => 'c_i_events_list_ns',
    			'type'              => 'wysiwyg',
                        'extra'             => array('editor_type' => 'advanced'),
                        'assign'            => 'c_i_events_list',
                        'required'          => true
                    )
    		)
        );

    public function info()
    {
        
        $info = array(
            'name' => array(
                'en' => 'Calendar'
            ),
            'description' => array(
                'en' => 'Manage your calendar.'
            ),
            'frontend' => TRUE,
            'backend' => TRUE,
            'menu' => 'content',
            'sections' => array(
                'calendar' => array(
                    'name' => 'calendar_sections.calendar',
                    'uri' => 'admin/calendar',
                    'shortcuts' => array(
                        array(
                            'name' => 'calendar_shortcuts.new_calendar_entry',
                            'uri' => 'admin/calendar/types',
                            'class' => 'add'
                        )
                    )
                ),
                'categories' => array(
                    'name' => 'calendar_sections.categories',
                    'uri' => 'admin/calendar/categories',
                    'shortcuts' => array(
                        array(
                            'name' => 'calendar_shortcuts.new_category',
                            'uri' => 'admin/calendar/categories/create',
                            'class' => 'add'
                        )
                    )
                ),
                'item_types' => array(
                    'name' => 'calendar_sections.item_types',
                    'uri' => 'admin/calendar/types',
                    'shortcuts' => array(
                        array(
                            'name' => 'calendar_shortcuts.new_type',
                            'uri' => 'admin/calendar/types/create',
                            'class' => 'add'
                        )
                    )
                )
            )
        );
        
        if($this->uri->segment(4) == 'fields')
        {
            $info['sections']['item_types']['shortcuts'][] = array(
                'name'      => 'calendar_shortcuts.new_field',
                'uri'       => 'admin/calendar/types/newfield/'.$this->uri->segment(5),
                'class'     => 'add'
            );
        }
        
        return $info;
    }

    public function install()
    {
        $this->dbforge->drop_table('calendar');
        $this->dbforge->drop_table('calendar_categories');
        $this->dbforge->drop_table('calendar_item_types');
        
        $calendar_table     = " CREATE  TABLE IF NOT EXISTS `".$this->db->dbprefix('calendar')."` (
                                `id` INT(11) NOT NULL AUTO_INCREMENT ,
                                `date_start` DATETIME NOT NULL ,
                                `date_end` DATETIME NULL ,
                                `restricted_to` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL DEFAULT NULL ,
                                `category` INT(11) NOT NULL ,
                                `item_type` INT(11) NOT NULL ,
                                `recurrence` ENUM('once','daily','weekly','monthly','annually') NULL DEFAULT 'once' ,
                                `stream_entry_id` INT(11) NOT NULL ,
                                `created_on` INT(11) NOT NULL ,
                                `updated_on` INT(11) NULL ,
                                `created_by` INT(11) NOT NULL,
                                PRIMARY KEY (`id`) )
                                ENGINE = MyISAM";
        
        $categories_table   = " CREATE  TABLE IF NOT EXISTS `".$this->db->dbprefix('calendar_categories')."` (
                                `id` INT(11) NOT NULL AUTO_INCREMENT ,
                                `name` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
                                `item_color` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
                                PRIMARY KEY (`id`) )
                                ENGINE = MyISAM";
        
        $item_types_table   = " CREATE  TABLE IF NOT EXISTS `".$this->db->dbprefix('calendar_item_types')."` (
                                `id` INT(11) NOT NULL AUTO_INCREMENT ,
                                `stream_id` INT(11) NOT NULL ,
                                `admin_layout` TEXT NOT NULL ,
                                `public_layout` TEXT NOT NULL ,
                                `public_layout_full` TEXT NOT NULL ,
                                PRIMARY KEY (`id`) )
                                ENGINE = MyISAM";
        
        $create_calendar   = $this->db->query($calendar_table);
        $create_categories = $this->db->query($categories_table);
        $create_item_types = $this->db->query($item_types_table);
        
        // lets create new calendar item type
        // default created type will have two fields: title, description
        $this->add_events_stream();
        
        if(!$create_calendar){ return false; }
        if(!$create_categories){ return false; }
        if(!$create_item_types){ return false; }
        
        return true;
    }

    public function uninstall()
    {
        // we need to delete all streams created as calendar item type
        $this->remove_related_streams();
        
        // lets drop our tables
        $this->dbforge->drop_table('calendar');
        $this->dbforge->drop_table('calendar_categories');
        $this->dbforge->drop_table('calendar_item_types');
        
        return TRUE;
    }


    public function upgrade($old_version)
    {
        return TRUE;
    }
    
    private function add_events_stream()
    {
        $this->streams->streams->add_stream('Events', 'c_i_events_list', 'c_i_events_list_ns', null, 'Calendar event type.');
        
        foreach($this->event_columns as $slug => $column)
        {
            $this->streams->fields->add_field($column['field']);
        }
        
        $stream = $this->streams->streams->get_stream('c_i_events_list', 'c_i_events_list_ns');
        
        $this->db->insert('calendar_item_types', array(
            'stream_id'             => $stream->id,
            'admin_layout'          => '{{ entry:title }}',
            'public_layout'         => '{{ entry:title }}',
            'public_layout_full'    => '<div class="blog_post">
                                            <div class="post_heading">
                                                <h4>{{ entry:title }}</h4>
                                            </div>
                                            <div class="post_body">
                                                {{ entry:description }}
                                            </div>
                                            <br/>
                                            <p class="post_date"><span class="post_date_label">From {{ date_start }} to {{ date_end }}</p>
                                        </div>'
        ));
        
        $this->db->insert('calendar_categories', array(
            'name'          => 'Events',
            'item_color'    => '#00FF00'
        ));
    }
    
    private function remove_related_streams()
    {
        $item_types = $this->db->get('calendar_item_types')->result();
        
        if(count($item_types) > 0)
        {
            foreach($item_types as $key => $type)
            {
                $stream_fields  = $this->streams_m->get_stream_fields($type->stream_id);
                $stream         = $this->streams_m->get_stream($type->stream_id);
                
                if($stream_fields !== false)
                {
                    foreach($stream_fields as $key => $field)
                    {
                        $this->streams->fields->delete_field($field->field_slug, $field->field_namespace);
                    }
                }
                
                $this->streams->streams->delete_stream($stream->stream_slug, $stream->stream_namespace);
            }
        }
    }
    
}