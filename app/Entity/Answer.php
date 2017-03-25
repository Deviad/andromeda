<?php

namespace Entity;
use Db\DbObj;
use Entity\User;



class Answer extends DbObj
{


    public $id;

    public $user_id;

    public $event_id;

    public $answer;


    public function __construct() {
        $this->the_table = "`answers`";
    }


    public function insertAnswer() {


        $the_attrs = ['id','user_id', 'event_id', 'answer'];

        $filled_attrs_values = array();


        foreach($the_attrs as $attr) {

            if ($this->$attr) {



                $filled_attrs_values['attrs'][] = "`{$attr}`";
                if(is_array($this->$attr)) {
                    $this_attr_string = serialize($this->$attr);
                }
                else {
                    $this_attr_string = $this->$attr;

                }

                $filled_attrs_values['values'][] = "'$this_attr_string'";
            }

        }

        $the_filled_attrs = implode(", ", $filled_attrs_values['attrs']);

        $the_filled_values = implode(", ", $filled_attrs_values['values']);


        parent::addObj($this->the_table, $the_filled_attrs, $the_filled_values);

    }


}