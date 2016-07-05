<?php

namespace Geonamesorg\Database;

use \PDO;

class Database {

    private $servername;
    private $username;
    private $password;
    private $dbname;

    function __construct() {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "123123";
        $this->dbname = "test_1";
    }

    public function insert($importData, $arrayNames, $tableName) {
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $implodeName = $this->implodeName($arrayNames, array('before' => ':', 'after' => ', '));
            $stmt = $conn->prepare("INSERT INTO $tableName(" . implode(',', $arrayNames) . ") VALUES(" . $implodeName . ")");

            foreach ($arrayNames as $key => $value) {
                $stmt->bindParam(':' . $value, $$value);
            }
            foreach ($importData as $row) {
                extract($row);
                $stmt->execute();
            }
            return TRUE;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return FALSE;
        }
        $conn = null;
    }

    public function read($tableName) {
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $return = $conn->query('SELECT * FROM ' . $tableName)->fetchAll();
            return $return;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    private function implodeName($arrayNames, $glue = array('before' => '', 'after' => '',)) {
        $stringName = '';
        $before = $glue['before'];
        $after = $glue['after'];

        $array = $arrayNames;
        $arrayLength = count($array);
        $counter = 0;
        foreach ($array as $k => $value) {
            $counter++;
            if ($counter == $arrayLength) {
                $stringName.= $before . $value;
            } else {
                $stringName.= $before . $value . $after;
            }
        }
        return $stringName;
    }

}
