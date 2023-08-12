<?php
function post_curl($end_point, $post, $header = '')
{
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL             => $end_point,
        CURLOPT_POST            => true,
        CURLOPT_POSTFIELDS      => http_build_query($post),
        CURLOPT_HTTPHEADER      => (empty($header)) ? [] : $header,
        CURLOPT_SSL_VERIFYHOST  => 0,
        CURLOPT_SSL_VERIFYPEER  => 0,
        CURLOPT_RETURNTRANSFER  => true
    ));
    $result = curl_exec($ch);
    if (curl_errno($ch) != 0 && empty($result)) {
        $result = false;
    }
    curl_close($ch);
    return $result;
}

        $post_api = [
                'api_id' => '',
                'api_key' => '',
                'service' => 3136,
                'target' => 'gladys.markt',
                'quantity' => 50,
            ];
            $curl = post_curl('https://api.medanpedia.co.id/order', $post_api);
            $result = json_decode($curl, true);
            
            print_r($curl); 