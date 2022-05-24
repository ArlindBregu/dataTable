<?php
            require('pages/dataBaseLayer.php');
            $_metodoClient = $_SERVER['REQUEST_METHOD'];
            $array = array();
            $page = @$_POST['start'] ?? 0;
            $size = @$_POST['length'] ?? 20;
            $total = countRecord();
            $baseurl = "http://localhost:8080/index.php";
            $orderBy = $_POST['order'];
            $search = $_POST['search'];


            switch($_metodoClient){
                case 'POST':
                    if($search['value'] == ""){
                        $array['data'] = GET($page, $size, $orderBy);
                        $array['recordsFiltered'] = $total;
                        $array['recordsTotal'] = $toal;
                        echo json_encode($array);
                    }else{
                        $totalSearch = countRecordSearch($search['value']);
                        $array['data'] = search($page, $size, $search['value'], $orderBy);
                        $array['recordsFiltered'] = $totalSearch;
                        $array['recordsTotal'] = $totalSearch;
                        echo json_encode($array);
                    }
                    break;
                /*case 'POST':
                    $dati=json_decode(file_get_contents('php://input'),true);
                    POST($dati["birth_date"], $dati["first_name"], $dati["last_name"], $dati["gender"]);
                    echo json_encode($dati);
                    break;
                case 'PUT':
                    $datiPUT=json_decode(file_get_contents('php://input'),true);
                    PUT($_GET['id'], $datiPUT["birth_date"], $datiPUT["first_name"], $datiPUT["last_name"], $datiPUT["gender"]);
                    echo json_encode($datiPUT);
                    break;
                case 'DELETE':
                    DELETE($_GET['id']);
                    echo json_encode($array);
                    break;*/
            }
        ?>
