<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 20/12/2016
 * Time: 06:47 AM
 */
require_once __DIR__ . '/../core/class.core.php';

class Committee extends Core
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create_committee($name, $memberid, $session, $post)
    {
        $sql = "INSERT INTO committees (committee_name, member_id, session, post, date_added) VALUES ('$name',$memberid,'$session', '$post', CURRENT_TIMESTAMP)";

        return $this->exec($sql) or die($this->lastErrorMsg());
    }

    public function get_all_committees()
    {
        $sql = "SELECT committee_name FROM committees GROUP BY committee_name ORDER BY committee_name";
        $q = $this->query($sql) or die($this->lastErrorMsg());
        $array = [];
        while ($result = $q->fetchArray(SQLITE3_ASSOC)) {
            $array[] = $result;
        }
        return $array;
    }

    public function get_committee_groups()
    {
        $sql = "SELECT committee_name, session FROM committees GROUP BY committee_name, session ORDER BY session DESC ";
        $q = $this->query($sql) or die($this->lastErrorMsg());
        $array = [];
        while ($result = $q->fetchArray(SQLITE3_ASSOC)) {
            $array[] = $result;
        }
        return $array;
    }

    public function get_member_committee_portfolio($member_id)
    {
        $sql = "SELECT * FROM committees WHERE member_id = $member_id";
        $q = $this->query($sql) or die($this->lastErrorMsg());
        $array = [];
        while ($result = $q->fetchArray(SQLITE3_ASSOC)) {
            $array[] = $result;
        }
        return $array;
    }

    public function get_committee_group_member($name, $session)
    {
        $sql = "SELECT committees.*, members.id AS member_id, members.salutation, members.firstname, members.middlename, members.surname, members.phone1 FROM committees JOIN members ON members.id = committees.member_id WHERE session = '$session' AND committee_name = '$name'";

        $q = $this->query($sql) or die($this->lastErrorMsg());
        $array = [];
        while ($result = $q->fetchArray(SQLITE3_ASSOC)) {
            $array[] = $result;
        }
        return $array;
    }

    public function delete_member($id)
    {
        $sql = "DELETE FROM committees WHERE id = $id";
        return $this->exec($sql) or die($this->lastErrorMsg());
    }
}