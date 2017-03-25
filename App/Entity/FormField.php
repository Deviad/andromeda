<?php

namespace App\Entity;
use App\Db\DbMgmt;
use App\Db\DbObj;

class FormField
{


    public $the_table;

    public $id;

    public $event_id;

    public $type;

    public $language;

    public $title;

    public $slug;

    public $values;

    private $db;

    public function __construct(DbObj $dbObj) {
       $this->the_table = "`fields`";

       $this->db = $dbObj;
    }

    public  function getFormFields($event_id, $language)
    {
//        $the_attrs = 'event_id, language';

        $projection = '`id`, `event_id`, `type`, `language`, `title`, `slug`, `values`';

        $condition = " WHERE `event_id` = '{$event_id}' AND `language` = '{$language}'";

        $fetched_array = $this->db->getObj($projection, $this->the_table, $condition);
        $this->db = null;
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

        //converting array to string

        $the_filled_attrs = implode(", ", $filled_attrs_values['attrs']);
        $the_filled_values = implode(", ", $filled_attrs_values['values']);


        $this->db->addObj($this->the_table, $the_filled_attrs, $the_filled_values);
        $this->db = null;
    }


}