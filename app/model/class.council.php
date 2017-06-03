<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 20/12/2016
 * Time: 06:47 AM
 */
require_once __DIR__ . '/../core/class.core.php';

class Council extends Core
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create_council($memberid, $session, $post)
    {
        $sql = "INSERT INTO councils (member_id, session, post, date_added) VALUES ($memberid,'$session', '$post', CURRENT_TIMESTAMP)";

        return $this->exec($sql) or die($this->lastErrorMsg());
    }

    public function get_council_groups()
    {
        $sql = "SELECT session FROM councils GROUP BY session ORDER BY session DESC ";
        $q = $this->query($sql) or die($this->lastErrorMsg());
        $array = [];
        while ($result = $q->fetchArray(SQLITE3_ASSOC)) {
            $array[] = $result;
        }
        return $array;
    }

    public function get_member_council_portfolio($member_id)
    {
        $sql = "SELECT * FROM councils WHERE member_id = $member_id";
        $q = $this->query($sql) or die($this->lastErrorMsg());
        $array = [];
        while ($result = $q->fetchArray(SQLITE3_ASSOC)) {
            $array[] = $result;
        }
        return $array;

    }

    public function get_council_group_member($session)
    {
        $sql = "SELECT councils.*, members.id AS member_id, members.salutation, members.firstname, members.middlename, members.surname, members.phone1 FROM councils JOIN members ON members.id = councils.member_id WHERE session = '$session'";

        $q = $this->query($sql) or die($this->lastErrorMsg());
        $array = [];
        while ($result = $q->fetchArray(SQLITE3_ASSOC)) {
            $array[] = $result;
        }
        return $array;
    }


    public function delete_member($id)
    {
        $sql = "DELETE FROM councils WHERE id = $id";
        return $this->exec($sql) or die($this->lastErrorMsg());
    }
}