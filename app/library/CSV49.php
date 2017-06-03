<?php

/**
 * Created by PhpStorm.
 * User: Funsho
 * Date: 04/11/2016
 * Time: 5:10 AM
 */

define('ROOT', 'app/');

class CSV49
{
    public $states_code_and_geopolitical_zones;
    public $geopolitical_zones;
    public $states_lga_and_geolocation;
    public $GSM_network_providers_phone_number_prefixes;
    public $states_and_capital_geolocation;
    public $universities;

    public function __construct()
    {
        $this->states_code_and_geopolitical_zones = fopen(ROOT . "third_party/csv49/csv/csv1.csv", "r");
        $this->geopolitical_zones = fopen(ROOT . "third_party/csv49/csv/csv2.csv", "r");
        $this->states_lga_and_geolocation = fopen(ROOT . "third_party/csv49/csv/csv3.csv", "r");
        $this->GSM_network_providers_phone_number_prefixes = fopen(ROOT . "third_party/csv49/csv/csv4.csv", "r");
        $this->states_and_capital_geolocation = fopen(ROOT . "third_party/csv49/csv/csv5.csv", "r");
        $this->universities = fopen(ROOT . "third_party/csv49/csv/csv6.csv", "r");
    }

    public function get_states_code_and_geopolitical_zones()
    {
        $fh = $this->states_code_and_geopolitical_zones;

        $array = array();
        $i = 0;
        while (!feof($fh)) {
            $i++;
            $line = rtrim(fgets($fh));
            if ($i === 1) continue;
            $data = explode(',', $line);
            if (!empty($data[0])) {
                $sub_array = array(
                    'code' => $data[0],
                    'state' => $data[1],
                    'gp-zone' => $data[2],
                );
                $array[] = $sub_array;
            }
        }
        return $array;
    }

    public function get_geopolitical_zones()
    {
        $fh = $this->geopolitical_zones;

        $array = array();
        $i = 0;
        while (!feof($fh)) {
            $i++;
            $line = rtrim(fgets($fh));
            if ($i === 1) continue;
            $data = explode(',', $line);
            if (!empty($data[0])) {
                $sub_array = array(
                    'code' => $data[0],
                    'gp-zone' => $data[1],
                );
                $array[] = $sub_array;
            }
        }
        return $array;
    }

    public function get_states_lga_and_geolocation()
    {
        $fh = $this->states_lga_and_geolocation;

        $array = array();
        $i = 0;
        while (!feof($fh)) {
            $i++;
            $line = rtrim(fgets($fh));
            if ($i === 1) continue;
            $data = explode(',', $line);
            if (!empty($data[0])) {
                $sub_array = array(
                    'code' => $data[0],
                    'state' => $data[1],
                    'lga' => $data[2],
                    'lat' => $data[3],
                    'lon' => $data[4],
                );
                $array[] = $sub_array;
            }
        }
        return $array;
    }

    public function get_GSM_network_providers_phone_number_prefixes()
    {
        $fh = $this->GSM_network_providers_phone_number_prefixes;

        $array = array();
        $i = 0;
        while (!feof($fh)) {
            $i++;
            $line = rtrim(fgets($fh));
            if ($i === 1) continue;
            $data = explode(',', $line);
            if (!empty($data[0])) {
                $sub_array = array(
                    'mcc-mnc' => $data[0],
                    'provider' => $data[1],
                    'prefix' => $data[2],
                );
                $array[] = $sub_array;
            }
        }
        return $array;
    }

    public function get_states_and_capital_geolocation()
    {
        $fh = $this->states_and_capital_geolocation;

        $array = array();
        $i = 0;
        while (!feof($fh)) {
            $i++;
            $line = rtrim(fgets($fh));
            if ($i === 1) continue;
            $data = explode(',', $line);
            if (!empty($data[0])) {
                $sub_array = array(
                    'code' => $data[0],
                    'state' => $data[1],
                    'capital' => $data[2],
                    'lat' => $data[3],
                    'lon' => $data[4],
                );
                $array[] = $sub_array;
            }
        }
        return $array;
    }

    public function universities()
    {
        $fh = $this->universities;

        $array = array();
        $i = 0;
        while (!feof($fh)) {
            $i++;
            $line = rtrim(fgets($fh));
            if ($i === 1) continue;
            $data = explode(',', $line);
            if (!empty($data[0])) {
                $sub_array = array(
                    'id' => $data[0],
                    'name' => $data[1],
                );
                $array[] = $sub_array;
            }
        }
        return $array;
    }

}