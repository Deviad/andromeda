<?php

namespace Entity;
use Db\DbObj;

class FormField extends DbObj
{


    public $the_table;

    public $id;

    public $event_id;

    public $type;

    public $language;

    public $title;

    public $slug;

    public $values;

    public function __construct() {
       $this->the_table = "`fields`";
    }

    public  function getFormFields($event_id, $language)
    {
//        $the_attrs = 'event_id, language';

        $projection = '`id`, `event_id`, `type`, `language`, `title`, `slug`, `values`';

        $condition = " WHERE `event_id` = '{$event_id}' AND `language` = '{$language}'";

        $fetched_array = parent::getObj($projection, $this->the_table, $condition);

        return $fetched_array;
    }

    public function insertFormFields() {


        $the_attrs = ['id','event_id', 'type', 'language', 'title', 'slug', 'values'];

        $filled_attrs_values = array();


        foreach($the_attrs as $attr) {

            if ($this->$attr) {
                $filled_attrs_values['attrs'][] = "`{$attr}`";
                $this_attr_string = (string)$this->$attr;
                $filled_attrs_values['values'][] = "'$this_attr_string'";
            }

        }

        $the_filled_attrs = implode(", ", $filled_attrs_values['attrs']);

        $the_filled_values = implode(", ", $filled_attrs_values['values']);


        parent::addObj($this->the_table, $the_filled_attrs, $the_filled_values);

    }


}