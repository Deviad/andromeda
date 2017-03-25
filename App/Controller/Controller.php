<?php

namespace App\Controller;

use App\Db\DbMgmt;
use App\Db\DbObj;
use App\Entity\Answer;
use App\Entity\FormField;
use App\Entity\User;

class Controller
{

    private $db = null;

    public function __construct()
    {
        $dbMgmt = new DbMgmt();
        $this->db = new DbObj($dbMgmt);
    }


    public function loadData()
    {

        $event_id = $_GET['event_id'];
        $language = $_GET['language'];

        if (empty($event_id) || empty($language)) {
            throw new \Exception('Provide valid parameters');
        }

        try {

            $file_path = dirname(__DIR__) . '/EventDataFiles/' . $event_id . '-' . $language . '.json';
            if (!file_exists($file_path)) {
                throw new \Exception('Matching file not found');
            }
            $json_data = file_get_contents($file_path);
            $data_array = json_decode($json_data, true);

            $formatted_data = array();

            foreach ($data_array['data'] as $key => $value) {
                $formatted_data[] = $value;
            };

            foreach ($formatted_data as $value) {

                $field = new FormField($this->db);
                $field->id = $value['id'];
                $field->event_id = $value['id_event'];
                $field->type = $value['type'];
                $field->title = $value['title'];
                $field->slug = $value['slug'];
                $field->language = $language;
                $field->values = $value['values'];

                $field->insertFormFields();
            }

            echo "success";


        } catch (\Exception $e) {

            /*
             * This can be logged like this:
             * Log::error($e);
             */

            echo $e->getMessage();
        }

        return '';


    }

    public function index()
    {

        $event_id = $_GET['event_id'];
        $language = $_GET['language'];

        if (empty($event_id) || empty($language)) {
            throw new \Exception('Provide valid parameters');
        }

        try {




            $fields = new FormField($this->db);

            $fields = $fields->getFormFields($event_id, $language);


            print $this->render(dirname(__DIR__) . "/../index_view.php", array('fields' => $fields));


        } catch (\Exception $e) {

            echo $e->getMessage();
        }

        return '';


    }


    function register($request)
    {

        $user = new User($this->db);

        $user->name = htmlspecialchars($request['name']);

        $user->surname = htmlspecialchars($request['surname']);

        $user->email = htmlspecialchars($request['email']);

        $user->telephone = htmlspecialchars($request['telephone']);

        $user->insertUser();

        $user = $user->getUserbyEmail($request['email']);
        $user_id = $user[0]['id'];

        $answer = new Answer($this->db);
        $answer->id = substr(md5(sha1(time() . rand())), 0, 6);
        $answer->user_id = $user_id;
        $answer->event_id = $request['event_id'];

        $answer_data = array();

        foreach ($request as $key => $value) {
            switch ($key) {

                case 'name':
                case 'surname':
                case 'email':
                case 'telephone':
                    break;

                default:
                    $answer_data = [$key => $value];


            }






        }
        $answer->answer = $answer_data;
        $answer->insertAnswer();
    }

    function render($template, $param)
    {
        ob_start();
        extract($param, EXTR_SKIP);
        include($template);


    }
}