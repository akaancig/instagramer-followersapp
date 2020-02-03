<?php

    error_reporting(E_ALL);
    ini_set('display_errors',1);
    set_time_limit(0);
    require 'vendor/autoload.php';

    function objectToArray($d) {
        if (is_object($d)) {
            // Gelen nesnenin özelliklerini get_object_vars metodu
            // ile alırız
            $d = get_object_vars($d);
        }

        if (is_array($d)) {
            // Nesneden diziye çevirilmiş veriyi döndürür
            // burdaki __FUNCTION__ bir magic constanttır.
            // recursive gibi kendini çağırır
            return array_map(__FUNCTION__, $d);
        }
        else {
            // Return array
            return $d;
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

    try {
        /////////////////// ARANAN KULLANICI BİLGİLERİNİ ÇEKME //////////////

        $aranan_kullanici = "";
        $aranan_kullanici = $ig->people->getInfoByName("$aranan_kullanici");
        $aranan_kullanici_arr = json_decode("$aranan_kullanici");
        $aranan_kullanici_arr = objectToArray($aranan_kullanici_arr);
        $aranan_kullanici= $aranan_kullanici_arr["user"]["pk"];

        ///////////////// TAKİPÇİLERİN ÇEKİLMESİ ///////////////////

        $maxId = null;
        $page = 0;
        $k = 0;

        do{
            $response = $ig->people->getFollowers("$aranan_kullanici",$rankToken,null,$maxId);
            $arr[] = json_decode($response,true);
            $maxId = $response->getNextMaxId();
            $page+=1;
        }while($maxId !== null);

        for($i=0;$i < $page; $i++){
            $pages["$i"] =  count($arr["$i"]["users"]);
        }

        for($i=0; $i < $page; $i++){
            for($j=0; $j < $pages["$i"]; $j++){
                $takipciler["$k"] = $arr["$i"]["users"]["$j"]["username"];
                $k++;
            }
        }
        $followers_num = $k;

        /////////////// TAKİP EDİLENLERİN ÇEKİLMESİ //////////////////

        $maxId = null;
        $page = 0;
        $k = 0;

        do{
            $response = $ig->people->getFollowing("$aranan_kullanici",$rankToken,null,$maxId);
            $arr2[] = json_decode($response, true);
            $maxId = $response->getNextMaxId();
            $page += 1;
        }while($maxId !== null);

        //her bir sayfada kaç tane kişi tutulduğunu pages[0], pages[1]... de tutar.

        for ($i = 0; $i < $page; $i++) {
            $pages["$i"] = count($arr2["$i"]["users"]);
        }

        //tüm sayfalardaki kişi bilgilerini çeker.

        for($i=0; $i < $page; $i++){
            for($j=0; $j < $pages["$i"]; $j++){
                $takip["$k"]=$arr2["$i"]['users']["$j"]['username'];
                $k++;
            }
        }
        $following_num = $k;

        //////////////////// KARŞILIKLI TAKİP //////////////////////

        $k = 0;

        for($i=0;$i < $following_num;$i++){
            for($j=0;$j < $followers_num;$j++){
                if($takip ["$i"] == $takipciler ["$j"]){
                    $karsilikli["$k"] = $takip["$i"];
                    $k++;
                }
            }
        }

        print_r($karsilikli);

        /////////////// UNFOLLOWERS //////////////////

        $unfollowers = (array_diff($takip,$karsilikli));
        print_r($unfollowers);
        echo count($unfollowers);

        /////////////// HAYRANLAR ////////////////////

        $hayranlar = array_diff($takipciler,$karsilikli);
        print_r($hayranlar);
        echo count($hayranlar);

    } catch (\Exception $e) {
        echo $e->getMessage();
    }
