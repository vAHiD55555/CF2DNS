<?php

    function get_optimization_ip($type='v4') {
        $KEY = 'o1zrmHAF';
        try {
            $headers = array('Content-Type: application/json');
            $data = array("key" => $KEY, "type" => $type);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.hostmonit.com/get_optimization_ip');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36');
            $response = curl_exec($ch);
            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($http_status == 200) {
                return json_decode($response, true);
            } else {
                echo "CHANGE OPTIMIZATION IP ERROR: REQUEST STATUS CODE IS NOT 200\n";
                return null;
            }
            curl_close($ch);
        } catch (Exception $e) {
            echo "CHANGE OPTIMIZATION IP ERROR: " . $e->getMessage() . "\n";
            return null;
        }
    }

    $getList = get_optimization_ip();
    $array = [];
    if ( isset($getList['code'], $getList['total']) &&
        $getList['code'] === 200 && $getList['total'] > 0 ) {
        foreach ($getList['info'] as $key => $l) {
            $array = array_merge($array, $l);
        }
    }
    var_dump(array_slice($array, 0, 25));
