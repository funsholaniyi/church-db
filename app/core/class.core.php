<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 03/06/2016
 * Time: 4:22 PM
 */

require_once __DIR__ . '/../config/constants.inc';


class Core extends SQLite3
{

    public function __construct()
    {
        parent::__construct(DBNAME);
        @session_start();
    }

    public function is_unique($table, $column, $value)
    {
        $column = $this->clean_string($column);
        $value = $this->clean_string($value);

        $sql = 'SELECT id FROM ' . $table . ' WHERE ' . $column . ' = "' . $value . '" ';
        $q = $this->query($sql) or die($this->error);

        $r = $q->fetch_assoc();
        return !empty($r) ? false : true;

    }

    public function clean_string($string)
    {
        if(is_array($string)){
            foreach ($string as $item){
                $r[] = $this->clean_string($item);
            }
            return $r;
        }else{
            $string = trim(strip_tags($string));
            return static::escapeString($string);
        }
    }

    public function generate_string($length)
    {
        $newID = "";
        $passwordRandomString = "AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789_";

        for ($x = 0; $x < $length; $x++) {
            $newID .= substr($passwordRandomString, rand(0, 62), 1);
        }
        return $newID;
    }

    public function format_array_to_string($array)
    {
        if (!is_array($array)) {
            return $array;
        } else {
            $num = count($array);
            $tot = count($array);
            $new = '';
            foreach ($array as $value) {
                if (is_array($value)) {
                    $value = $this->format_array_to_string($value);
                }
                $num--;
                if ($num == 0 && $tot != 1) {
                    $new .= "and " . $value . ".";

                } elseif ($num == 0 && $tot == 1) {
                    $new .= $value . ".";

                } elseif ($num == 1) {
                    $new .= $value . " ";

                } else {
                    $new .= $value . ", ";
                }

            }
            return $new;
        }
    }

}