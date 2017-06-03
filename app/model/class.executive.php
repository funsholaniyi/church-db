<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 20/12/2016
 * Time: 06:47 AM
 */
require_once __DIR__ . '/../core/class.core.php';

class Executive extends Core
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create_executive($memberid, $session, $post)
    {
        $sql = "INSERT INTO executives (member_id, session, post, date_added) VALUES ($memberid,'$session', '$post', CURRENT_TIMESTAMP)";

        return $this->exec($sql) or die($this->lastErrorMsg());
    }

    public function get_executive_groups()
    {
        $sql = "SELECT session FROM executives GROUP BY session ORDER BY session DESC ";
        $q = $this->query($sql) or die($this->lastErrorMsg());
        $array = [];
        while ($result = $q->fetchArray(SQLITE3_ASSOC)) {
            $array[] = $result;
        }
        return $array;
    }
    public function get_member_executive_portfolio($member_id)
    {
        $sql = "SELECT * FROM executives WHERE member_id = $member_id";
        $q = $this->query($sql) or die($this->lastErrorMsg());
        $array = [];
        while ($result = $q->fetchArray(SQLITE3_ASSOC)) {
            $array[] = $result;
        }
        return $array;

    }

    public function get_executive_group_member($session)
    {
        $sql = "SELECT executives.*, members.id AS member_id, members.salutation, members.firstname, members.middlename, members.surname, members.phone1 FROM executives JOIN members ON members.id = executives.member_id WHERE session = '$session'";

        $q = $this->query($sql) or die($this->lastErrorMsg());
        $array = [];
        while ($result = $q->fetchArray(SQLITE3_ASSOC)) {
            $array[] = $result;
        }
        return $array;
    }

    public function delete_member($id)
    {
        $sql = "DELETE FROM executives WHERE id = $id";
        return $this->exec($sql) or die($this->lastErrorMsg());
    }
}