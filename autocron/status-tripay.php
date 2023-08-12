<?php
require '../mainconfig.php';

$datasee = $db->query("SELECT * FROM deposit WHERE status = 'Pending'");
if($datasee->num_rows == 0) {
    die("Deposit not found.");
} else {
    while($data = mysqli_fetch_assoc($datasee)) { 
       $id = $data['id'];
       $wid = $data['kode_deposit'];
       $user = $data['username'];
       $provider = $data['provider'];
       $method = $data['payment'];
       $uniq = $data['acakin'];
       $amount = $data['jumlah_transfer'];
       $getReal = $data['get_saldo'];
       $tid = $data['tid'];
       
       $apiKey = 'bTr7166E8G6ab18MWdtQIRJy1Uytj4VL2a7uxWxM';
       $privateKey = 'puHG1-MULWt-19ZkW-5erTZ-35f5z';
       $payload = ['reference'	=> $tid];
    
       $curl = curl_init();
       curl_setopt_array($curl, [
           CURLOPT_FRESH_CONNECT  => true,
           CURLOPT_URL            => 'https://tripay.co.id/api/transaction/detail?'.http_build_query($payload),
           CURLOPT_RETURNTRANSFER => true,
           CURLOPT_HEADER         => false,
           CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
           CURLOPT_FAILONERROR    => false,
       ]);
       
       $response = curl_exec($curl);
       $result = json_decode($response, true);
       //print_r($result);
       
       /* output */
       $status = $result['data']['status'];
       
       if($status == 'PAID') {
           $rStatus = 'Success';
       } else {
           $rStatus = 'Pending';
       }
       
       if($rStatus == 'Success') {
	   $up = $db->query("UPDATE deposit SET status = 'Success' WHERE id = '$id'");
           $up = $db->query("UPDATE users SET saldo = saldo+$getReal WHERE username = '$user'");
	   
	   if($up == true) {
	       $db->query("INSERT INTO history_saldo VALUES (null,'$user','Penambahan Saldo','$getReal','Deposit :: $wid','$date $time')");
	       print 'Deposit Successfully';
	   } else {
	       print 'trauble';
	   }	  
	} else {
	    print 'status not paid';
	}
    }
}
?>