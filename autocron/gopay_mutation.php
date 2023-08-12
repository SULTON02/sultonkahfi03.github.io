<?php

require '../mainconfig.php';

use GojekPay\GojekPay;

$gopay = mysqli_query($db, "SELECT * FROM gopay WHERE id = '1'");
$gopay = $gopay->fetch_assoc();

$token = $gopay['token'];

if (!empty($token)) {
    $init = new GojekPay($token);
    $mutation = json_decode($init->getTransactionHistory(),true);
    if (isset($mutation['data']['success'])) {
        foreach ($mutation['data']['success'] as $mut) {
            if ($mut['status'] == 'SUCCESS' && $mut['type'] == 'credit') {
                if (date('Y-m-d') == date('Y-m-d', strtotime($mut['transacted_at']))) {
                    $amount = $mut['amount']['value'];
                    $transaction_ref = $mut['transaction_ref'];
                    $description = $mut['description'];
                    $transacted_at = date('Y-m-d H:i:s', strtotime($mut['transacted_at']));
                                        
                    $search = mysqli_query($db, "SELECT * FROM gopay_mutations WHERE transaction_ref = '" . $transaction_ref . "' AND amount = '" . $amount . "'");
    
                    if (mysqli_num_rows($search) == 0) {
                        mysqli_query($db, "INSERT INTO gopay_mutations VALUES('', 'credit', '". $transaction_ref ."', '". $description ."', '". $amount ."', '". $transacted_at ."', 'UNREAD')");
                    }
                }
            }
        }
    }
}
