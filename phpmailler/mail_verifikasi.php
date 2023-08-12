<?php
require_once '../mainconfig.php';
if (isset($_GET['send'])) {
    $Address = $_GET['email'];
    $otp = $_GET['otp'];
    
    $SmtpHost = $_CONFIG['smtp']['host'];
    $SmtpUser = $_CONFIG['smtp']['username'];
    $SmtpPass = $_CONFIG['smtp']['password'];

    $NamaWeb = $web['NamaWeb'];

    include_once "classes/class.phpmailer.php";
    $Letter = "
<html>

<head>
    
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    <meta name='author' content='RAP Code'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.0.7/css/all.css'>
    <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
    <style type='text/css'>
        body,table,td,a{-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}table,td{mso-table-lspace:0pt;mso-table-rspace:0pt}table{border-collapse:collapse!important}body{font-family:'Dosis';height:100%!important;margin:0!important;padding:0!important;width:100%!important}a[x-apple-data-detectors]{color:inherit!important;text-decoration:none!important;font-size:inherit!important;font-family:inherit!important;font-weight:inherit!important;line-height:inherit!important}@media screen and (max-width:600px){h1{font-size:32px!important;line-height:32px!important}}div[style*='margin: 16px 0;']{margin:0!important}
    </style>
</head>

<body style='background-color:#f4f4f4;margin:0 !important;padding:0 !important;'>
    <div
        style='display:none;font-size:1px;color:#fefefe;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;'>
        Kami senang Anda ada di sini! Bersiaplah untuk menggunakan akun baru Anda.
    </div>

    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
        <tr>
            <td bgcolor='#354da1' align='center'>
                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:600px;'>
                    <tr>
                        <td style='padding-bottom:40px;'></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor='#354da1' align='center' style='padding:0px 10px 0px 10px;'>
                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                    <tr>
                        <td bgcolor='#ffffff' align='center' valign='top'
                            style='padding:40px 20px 20px 20px;border-radius:4px 4px 0px 0px;letter-spacing:4px;line-height:48px;'>
                            <h1 style='color: #111111;font-size:48px;font-weight:bold;margin:0;'>
                                Selamat Datang!
                            </h1>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor='#f4f4f4' align='center' style='padding:0px 10px 0px 10px;'>
                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:600px;'>
                    <tr>
                        <td bgcolor='#ffffff' align='left' style='padding:20px 30px 40px 30px;line-height:25px;'>
                            <p style='color:#666666;font-size:18px;font-weight:bold;margin:0;'>                            
                                Terima kasih telah melakukan pendaftaran pada <b>".$NamaWeb."</b>.<br /><br />
                                Kode OTP berlaku 5 menit, jika invalid lakukan permintaan ulang.
                                
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor='#ffffff' align='left'>
                            <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                <tr>
                                    <td bgcolor='#ffffff' align='center' style='padding:40px 30px 60px 30px;'>
                                        <table border='0' cellspacing='0' cellpadding='0'>
                                            <tr>
                                                <td align='center' style='border-radius:3px;padding:0 20px 0 20px' bgcolor='#354da1'>
                                                  <h2 style='color: #fff;'>".$otp."</h2>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor='#ffffff' align='left' style='padding:0px 30px 0px 30px;line-height:25px;'>
                            <p style='color:#666666;font-size: 18px;font-weight:bold;margin:0;'>
                                Abaikan email ini jika Anda tidak melakukan pendaftaran pada <b>".$NamaWeb."</b>.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor='#ffffff' align='left'
                            style='padding:0px 30px 40px 30px;border-radius:0px 0px 4px 4px;line-height:25px;'>
                            <p style='color:#666666;font-size:18px;font-weight:bold;margin:0;'>
                            <br>
                                Terimakasih,<br>
                                
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor='#f4f4f4' align='center' style='padding:30px 10px 0px 10px;'>
                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:600px;'>
                    <tr>
                        <td bgcolor='#f4f4f4' align='left' style='padding:0px 30px 30px 30px;line-height:18px;'>
                            <p style='color:#666;font-size:14px;font-weight:bold;margin:0;text-align:center;'>
                                Anda menerima email ini karena mendaftarakan akun pada <br />
                                <a href='".config('web', 'url')."' target='_blank'
                                    style='color:#111111;text-decoration:none;'><b>".$NamaWeb."</b></a>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor='#f4f4f4' align='left'
                            style='padding:0px 30px 30px 30px;color:#666666;font-size:14px;font-weight:bold;line-height:18px;'>
                            <p style='margin:0;text-align:center;'>
                                <b style='color:blue;'>".config('web', 'author')."</b>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>   
    ";                
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPDebug = 2;
    $mail->Host = $SmtpHost;
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $mail->Username = $SmtpUser; //user email
    $mail->Password = $SmtpPass; //password email
    $mail->setFrom($SmtpUser, $NamaWeb);
    $mail->addReplyTo($SmtpUser, $NamaWeb);
    $mail->Subject = "Aktivasi Akun - " . $NamaWeb . ""; //subyek email
    $mail->AddAddress($Address, $Address); //tujuan email
    $mail->Timeout = 60; // set the timeout (seconds)
    $mail->SMTPKeepAlive = true; // don't close the connection between
    $mail->MsgHTML($Letter);

    if (!$mail->Send()) {
        echo json_encode(array('status' => 'fail', 'message' => $mail->ErrorInfo));
    } else {
        echo json_encode(array('status' => 'ok'));
    }
}
?>
