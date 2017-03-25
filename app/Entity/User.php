<?php

namespace Entity;
use Db\DbObj;

class User extends DbObj
{


    public $the_table;

    public $id;

    public $name;

    public $surname;

    public $email;

    public $telephone;

    public function __construct() {
        $this->the_table = "`users`";
    }


    public function getUserbyEmail($email) {
        $projection = '`id`, `name`, `surname`, `email`, `telephone`';
        $condition = " WHERE `email` = '{$email}'";
        $fetched_array = parent::getObj($projection, $this->the_table, $condition);
        return $fetched_array;
    }


    public  function getFormFields($event_id, $language)
    {
//        $the_attrs = 'event_id, language';

        $projection = '`id`, `event_id`, `type`, `language`, `title`, `slug`, `values`';

        $condition = " WHERE `event_id` = '{$event_id}' AND `language` = '{$language}'";

        $fetched_array = parent::getObj($projection, $this->the_table, $condition);

        return $fetched_array;
    }





    public function insertUser() {


        $the_attrs = ['name', 'surname', 'email', 'telephone'];

        $filled_attrs_values = array();


        foreach($the_attrs as $attr) {

            if ($this->$attr) {
                $filled_attrs_values['attrs'][] = "`{$attr}`";
                $this_attr_string = (string)$this->$attr;
                $filled_attrs_values['values'][] = "'$this_attr_string'";
            }

            else {
                throw new \Exception("Missing field {$this->$attr}");
            }

        }

        $the_filled_attrs = implode(", ", $filled_attrs_values['attrs']);

        $the_filled_values = implode(", ", $filled_attrs_values['values']);


        parent::addObj($this->the_table, $the_filled_attrs, $the_filled_values);

    }


}