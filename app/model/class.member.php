<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 14/12/2016
 * Time: 02:13 PM
 */
require_once __DIR__ . '/../core/class.core.php';

class Member extends Core
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create_member($salutation, $firstname, $middlename, $surname, $nickname, $department, $phone1, $phone2, $email, $stateoforigin, $stateofresidence, $address, $homeparish, $dob, $subgroup, $admissionyear, $graduationyear, $profilepicture, $biography)
    {
        $sql = "INSERT INTO members (salutation, firstname, middlename, surname, nickname, department, phone1, phone2, email, state_of_origin, state_of_residence, address, home_parish, dob, subgroup, admission_year, graduation_year, profile_picture, biography, date_added) VALUES ('$salutation', '$firstname', '$middlename', '$surname', '$nickname', '$department', '$phone1', '$phone2', '$email', '$stateoforigin', '$stateofresidence', '$address', '$homeparish', '$dob', '$subgroup', '$admissionyear', '$graduationyear', '$profilepicture', '$biography', CURRENT_TIMESTAMP)";

        return $this->exec($sql) or die($this->lastErrorMsg());
    }

    public function get_a_member($id)
    {
        $sql = "SELECT * FROM members WHERE id = $id";
        $q = $this->query($sql) or die($this->lastErrorMsg());
        return $q->fetchArray(SQLITE3_ASSOC);
    }

    public function get_all_members()
    {
        $sql = "SELECT * FROM members ORDER BY surname ASC";
        $q = $this->query($sql) or die($this->lastErrorMsg());
        $array = [];
        while ($result = $q->fetchArray(SQLITE3_ASSOC)) {
            $array[] = $result;
        }
        return $array;
    }

    public function get_upcoming_birthdays()
    {
        $today = date('m-d', time());
        $sql = "SELECT * FROM members WHERE dob LIKE '%$today%'";
        $q = $this->query($sql) or die($this->lastErrorMsg());
        $array = [];
        while ($result = $q->fetchArray(SQLITE3_ASSOC)) {
            $array[] = $result;
        }
        return $array;
    }


    public function search_member($keyword, $field='')
    {
        if(!empty($field)){
            $sql = "SELECT * FROM members WHERE $field LIKE '%$keyword%'";
        }else{
            $sql = "SELECT * FROM members WHERE firstname LIKE '%$keyword%' OR middlename LIKE '%$keyword%' OR surname LIKE '%$keyword%' OR nickname LIKE '%$keyword%' OR department LIKE '%$keyword%' OR members.phone1 LIKE '%$keyword%' OR phone2 LIKE '%$keyword%' OR email LIKE '%$keyword%' OR state_of_origin LIKE '%$keyword%' OR state_of_residence LIKE '%$keyword%' OR address LIKE '%$keyword%' OR home_parish LIKE '%$keyword%' OR dob LIKE '%$keyword%' OR subgroup LIKE '%$keyword%' OR admission_year LIKE '%$keyword%' OR graduation_year LIKE '%$keyword%'";

        }
        $q = $this->query($sql) or die($this->lastErrorMsg());
        $array = [];
        while ($result = $q->fetchArray(SQLITE3_ASSOC)) {
            $array[] = $result;
        }
        return $array;
    }

    public function update_member($id,$salutation, $firstname, $middlename, $surname, $nickname, $department, $phone1, $phone2, $email, $stateoforigin, $stateofresidence, $address, $homeparish, $dob, $subgroup, $admissionyear, $graduationyear, $biography)
    {
        $sql = "UPDATE members SET salutation = '$salutation', firstname = '$firstname', middlename = '$middlename', surname = '$surname', nickname = '$nickname', department = '$department', phone1 = '$phone1', phone2 = '$phone2', email = '$email', state_of_origin = '$stateoforigin', state_of_residence = '$stateofresidence', address = '$address', home_parish = '$homeparish', dob = '$dob', subgroup = '$subgroup', admission_year = '$admissionyear', graduation_year = '$graduationyear', biography = '$biography' WHERE id = $id";
        return $this->exec($sql) or die($this->lastErrorMsg());
    }

    public function delete_member($id)
    {
        $sql = "DELETE FROM members WHERE id = $id";
        return $this->exec($sql) or die($this->lastErrorMsg());
    }
}