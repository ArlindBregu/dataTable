<?php

    function countRecord(){
        require('db.php');
        $query = "SELECT COUNT(*)  FROM employees";
        $result = $mysqli->query($query);
        $row= $result-> fetch_array();
        return $row[0];
    }

    function GET($first, $lenght, $orderBy){
        require('db.php');
        $function = ifOrder($orderBy);
        $query = "SELECT * FROM employees ORDER BY $function[0] $function[1] LIMIT $first, $lenght";
        $result = $mysqli->query($query);
        $rows = array();
        while ($row= $result-> fetch_assoc()) {
            $rows[]=$row;
        }
        return $rows;
    }

    function ifOrder($orderByBy){
        if($orderBy[0]['column'] == 0){
            $columnWay[0] = "id";
        }else if($orderBy[0]['column'] == 1){
            $columnWay[0] = "birth_date";
        }else if($orderBy[0]['column'] == 2){
            $columnWay[0] = "first_name";
        }else if($orderBy[0]['column'] == 3){
            $columnWay[0] = "last_name";
        }else if($orderBy[0]['column'] == 4){
            $columnWay[0] = "gender";
        }

        if($orderBy[0]['dir'] == 'asc'){
            $columnWay[1] = "ASC";
        }else{
            $columnWay[1] = "DESC";
        }

        return $columnWay;
    }

    function countRecordSearch($searchValue){
        require('db.php');
        $query = "SELECT COUNT(*) 
                FROM employees 
                WHERE last_name LIKE '%$searchValue%' OR id  LIKE '%$searchValue%' OR birth_date LIKE '%$searchValue%' OR first_name LIKE '%$searchValue%'";
        $result = $mysqli->query($query);
        $row= $result-> fetch_array();
        return $row[0];
    }

    function search($first, $lenght, $orderBy, $searchValue){
        require('db.php');
        $function = ifOrder($orderBy);
        $query = "SELECT COUNT(*) 
                FROM employees 
                WHERE last_name LIKE '%$searchValue%' OR id  LIKE '%$searchValue%' OR birth_date LIKE '%$searchValue%' OR first_name LIKE '%$searchValue%'
                ORDER BY $function[0] $function[1] LIMIT $first, $lenght";
        $rows = array();
        while ($row= $result-> fetch_assoc()) {
            $rows[]=$row;
        }
        return $rows;
    }

?>