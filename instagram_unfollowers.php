<?php
    error_reporting(E_ALL);
    ini_set('display_errors',1);
    set_time_limit(0);
    require 'vendor/autoload.php';

    function list_array($arr){
        foreach ($arr as $key => $value){
            if(is_array($value)) {
                echo "<br>$key<br>";
                list_array($value);
            }else{
                echo "<br>$key -> $value<br>";
            }
        }
    }

    $rankToken = \InstagramAPI\Signatures::generateUUID();

    \InstagramAPI\Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;

    $username = '';
    $password = '';

    $ig = new \InstagramAPI\Instagram();

    try {
        $ig->login($username,$password);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
    $maxId = null;
    $page = 0;

    try {
        ///////////////TAKİPÇİLERİN ÇEKİLMESİ////////////////

        do {
            $response = $ig->people->getSelfFollowers($rankToken, null, $maxId);
            $arr2[] = json_decode($response, true);
            $maxId = $response->getNextMaxId();
            $page += 1;
        } while ($maxId !== null);

        //her bir sayfada kaç tane kişi tutulduğunu pages[0], pages[1]... de tutar.

        for ($i = 0; $i < $page; $i++) {
            $pages["$i"] = count($arr2["$i"]["users"]);
        }

        $k=0;//takipçi sayısının tutulacağı değer.

        //tüm sayfalardaki kişi bilgilerini çeker.

        for($i=0; $i < $page; $i++){
            for($j=0; $j < $pages["$i"]; $j++){
                $takipciler["$k"] = $arr2["$i"]["users"]["$j"]["username"];
                $k++;
            }
        }

        $followers_num = $k;

        ///////////////TAKİP EDİLENLERİN ÇEKİLMESİ////////////

        $page=0;
        $maxId = null;
        do{
            $response = $ig->people->getSelfFollowing($rankToken, null, $maxId);
            $arr3[] = json_decode($response, true);
            $maxId = $response->getNextMaxId();
            $page += 1;
        }while($maxId !== null);
        //her bir sayfada kaç tane kişi tutulduğunu pages[0], pages[1]... de tutar.
        for ($i = 0; $i < $page; $i++) {
            $pages["$i"] = count($arr3["$i"]["users"]);
        }
        $k=0;//takip sayısının tutulacağı değer.
        //tüm sayfalardaki kişi bilgilerini çeker.
        for($i=0; $i < $page; $i++){
            for($j=0; $j < $pages["$i"]; $j++){
                $takip["$k"]=$arr3["$i"]['users']["$j"]['username'];
                $k++;
            }
        }
        $following_num = $k;

        //////////////KARŞILIKLI TAKİP/////////////////
        $k=0;
        for($i=0;$i < $following_num;$i++){
            for($j=0;$j < $followers_num;$j++){
                if($takip ["$i"] == $takipciler ["$j"]){
                    $karsilikli["$k"] = $takip["$i"];
                    $k++;
                }
            }
        }

        ///////////// UNFOLLOWERS //////////////////

        $unfollowers = (array_diff($takip,$karsilikli));

        /////////////// HAYRANLAR ////////////////////

        $hayranlar = array_diff($takipciler,$karsilikli);

    }
    catch (\Exception $e) {
        echo $e->getMessage();
    }
