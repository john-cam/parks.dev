<?php

class Park
{
    // our connection to the database
    public static $dbc = null;

    // establish a database connection if we do not have one
    public static function dbConnect() {
        if (!is_null(self::$dbc)) {
            return self::$dbc;
        } else {
            self::$dbc = require 'db_connection.php';
            return self::$dbc;
        }
    }

     // returns the number of records in the database
     public static function count() {
         $connection = self::dbConnect();
         $query = "SELECT count(*) FROM national_parks";
         $statement = $connection->prepare($query);
         $statement->execute();
         $count = $statement->fetchColumn();
         return $count;
     }

    // returns all the records
    public static function all() {
        $connection = self::dbConnect();
        $query = "SELECT * FROM national_parks";
        $statement = $connection->prepare($query);
        $statement->execute();
        $allRows = $statement->fetchAll(PDO::FETCH_ASSOC);
        $array = [];

        foreach($allRows as $row) {
            $park = new Park();
            $park->id = $row['id'];
            $park->name = $row['name'];
            $park->location = $row['location'];
            $park->dateEstablished = $row['date_established'];
            $park->areaInAcres = $row['area_in_acres'];
            $park->description = $row['description'];
            array_push($array, $park);
        }
        return $array;
    }

    // get the page number
    public static function getPageNumber() {
        $data = [];
        $data['page'] = (isset($_GET['page'])) ? $_GET['page'] : 1;
        return $data;
    }

    public static function getLastPage($limit) {
        // establish database connection
        $connection = self::dbConnect();
        // get the total number of columns
        $getTotal = "SELECT count(*) FROM national_parks";
        $statement = $connection->prepare($getTotal);
        $statement->execute();
        $total = $statement->fetchColumn();
        $lastPage = ceil($total / $limit);
        return $lastPage;
    }

    public static function returnResults($limit) {

        // establish connection, offset and page number we are on
        $connection = self::dbConnect();
        extract(self::getPageNumber());
        $offset = ($page - 1) * $limit;
        if($page < 1) {
            $offset = 0;
        }

        // query the database to select the tables and fetch as an associative array
        $query = "SELECT * FROM national_parks LIMIT " . $limit . " OFFSET " . $offset;
        $result = $connection->prepare($query);
        $result->execute();
        $parksArray = $result->fetchAll(PDO::FETCH_ASSOC);
        $array = [];

        // create a new object for each result and push them to a new array
        foreach($parksArray as $row) {
            $park = new Park();
            $park->id = $row['id'];
            $park->name = $row['name'];
            $park->location = $row['location'];
            $park->dateEstablished = $row['date_established'];
            $park->areaInAcres = $row['area_in_acres'];
            $park->description = $row['description'];
            array_push($array, $park);
        }
        return $array;
    }

    /////////////////////////////////////
    // Instance Methods and Properties //
    /////////////////////////////////////

    // properties that represent columns from the database
    public $id;
    public $name;
    public $location;
    public $dateEstablished;
    public $areaInAcres;
    public $description;

    // inserts a record into the database
    public function insert($name, $location, $dateEstablished, $areaInAcres, $description) {
        $connection = self::dbConnect();
        $query = "INSERT INTO national_parks (name, location, date_established, area_in_acres, description) VALUES (:name, :location, :date_established, :area_in_acres, :description)";
        $statement = $connection->prepare($query);
        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->bindValue(':location', $location, PDO::PARAM_STR);
        $statement->bindValue(':date_established', $dateEstablished, PDO::PARAM_STR);
        $statement->bindValue(':area_in_acres', $areaInAcres, PDO::PARAM_INT);
        $statement->bindValue(':description', $description, PDO::PARAM_STR);
        $statement->execute();
        $id = $db->lastInsertId();
        return $id;
    }
}