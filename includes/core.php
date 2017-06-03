<?php

/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 20/11/2015
 * Time: 11:15 AM
 */

class Core extends Mysqli
{
    public function __construct()
    {
        parent::__construct('localhost', 'root', '', 'fmodb');
        @session_start();
        $_POST = $this->clean($_POST);
        $_GET = $this->clean($_GET);

        if (!empty($_SERVER['QUERY_STRING'])) {
            $this->getVars = $this->clean(explode('&', urldecode($_SERVER['QUERY_STRING'])));
        }

        date_default_timezone_set('Africa/Lagos');
    }

    public function clean($input)
    {
        if (is_array($input)) {
            $result = array();
            foreach ($input as $key => $item) {
                $clean = $this->clean($item);
                $result[$key] = $clean;
            }
        } else {
            $input = strip_tags($input);
            $input = trim($input);
            $result = $this->real_escape_string($input);
        }
        return $result;
    }



    public function add_member($firstname, $lastname, $room_num, $hall, $phone, $gender)
    {
        $sql = "INSERT INTO members (firstname, lastname, room_num, hall, phone, gender) VALUES ('$firstname', '$lastname', '$room_num', '$hall', '$phone', '$gender')";
        $this->query($sql) or die($this->error);
        return $this->insert_id;
    }

    public function check_phone($phone)
    {
        $sql = "SELECT phone FROM members WHERE phone = '$phone'";
        $query = $this->query($sql);
        if($query->num_rows > 0) return false;
        else return true;
    }
    public function get_members_list()
    {
        $sql = "SELECT * FROM members ORDER BY created_at DESC";
        $query = $this->query($sql);
        $out = array();
        while ($result = $query->fetch_assoc()) {
            $out[] = $result;
        }
        return $out;
    }


    public function get_member($id)
    {
        $sql = "SELECT * FROM members WHERE id = '$id'";
        $query = $this->query($sql);
        if($query->num_rows > 1) return false;
        else return $query->fetch_assoc();
    }
    
    
    public function edit_member($id, $firstname, $lastname, $room_num, $hall, $phone, $gender){
        $sql = "UPDATE members SET firstname = '$firstname', lastname = '$lastname', room_num = '$room_num', hall = '$hall', phone = '$phone', gender = '$gender' WHERE id = '$id'";
        $query = $this->query($sql);
    }
    
    public function delete_member($id)
    {
        $sql = "DELETE FROM members WHERE id = '$id'";
        return $this->query($sql);

    }


    private function get_phone_list()
    {
        $sql = "SELECT phone FROM members";
        $query = $this->query($sql);
        while ($result = $query->fetch_assoc()) {
            $out[] = $result;
        }
        return $out;
    }
    
    public function save_phone_list(){
        $phones = $this->get_phone_list();
        fopen('phones.csv','w');
        $fh = fopen('phones.csv','a');
        if(!empty($phones)){
            foreach ($phones as $phone){
                fwrite($fh,$phone['phone'].',');
            }
        }
        fclose($fh);
    }
}