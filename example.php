<?php
    require("login.php");
    $maxId = null;
    $page=0;

    try {
        do{
            $response = $ig->people->getFollowers("829429500",$rankToken,null,$maxId);
            $arr[] = json_decode($response,true);
            $maxId = $response->getNextMaxId();
            $page+=1;
        }while($maxId !== null && $page < 5);

        for($i=0;$i < $page; $i++){
            $pages["$i"] =  count($arr["$i"]["users"]);
        }

        $k=0;

        for($i=0; $i < $page; $i++){
            for($j=0; $j < $pages["$i"]; $j++){
                $kisiler["$k"]["pk"] = $arr["$i"]["users"]["$j"]["pk"];
                $kisiler["$k"]["private"] = $arr["$i"]["users"]["$j"]["is_private"];
                $k++;
            }
        }
        $followers_num = $k;

        for($i=0;$i < $k ;$i++){
            if($kisiler["$i"]["private"] != 1){
                echo $kisiler["$i"]["pk"]."<br>";
                echo "<br>".$kisiler["$i"]["private"]."<br>";
                $pk = $kisiler["$i"]["pk"];
                $ig->people->follow("$pk");
                sleep(10);
            }
        }

        //print_r($arr_info);

    } catch (\Exception $e) {
        echo $e->getMessage();
    }
