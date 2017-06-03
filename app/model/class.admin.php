<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 14/12/2016
 * Time: 12:01 PM
 */

require_once __DIR__ . '/../core/class.core.php';

class Admin extends Core
{
    public function __construct()
    {
        parent::__construct();
    }


    public function create_admin($username, $password)
    {
        $password = sha1($password);
        $sql = "INSERT INTO admins (username, password) VALUES ('$username', '$password')";
        $this->exec($sql) or die($this->lastErrorMsg());

    }

    public function check_admin($username, $password)
    {
        $password = sha1($password);
        $sql = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'";
        $query = $this->query($sql) or die($this->lastErrorMsg());
        return $query->fetchArray();
    }
}