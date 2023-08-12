<?php
define("BASEPATH", __DIR__.'/system/');

// application configuration
$_CONFIG = [
	'db' => [ // database
		'host' => 'localhost',        // host
		'username' => 'sultonka_sulton1', // username
		'password' => 'SULTONkahfi99', // password
		'name' => 'sultonka_sulton1'      // name
	],
	'web' => [ // website
		'environment' => 'production',                                // development or production
		'url' => 'https://sultonkahfi.my.id',                // url without '/' in end
		'assets' => 'https://sultonkahfi.my.id/assets', // assets url without '/' in end
		'title_web' => 'SMM PANEL TERMURAH', 
		'author' => 'sulton',                    
		'timezone' => 'Asia/Jakarta'                                                       
	],
	'smtp' => [ // SMTP MAILLER
		'host' => 'mail.sultonkahfi.my.id',          // host email
		'username' => 'ss@sultonkahfi.my.id', // user mail
		'password' => 'SULTONkahfi03'                // pass mail
	],
	'Wuzzpedia' => [ // licence
		         
	],
];

// WUZZPEDIA

require_once BASEPATH.'core.php';
require_once BASEPATH.'helpers/db.php';

// CUSTOM SISTEM 
require_once 'autocron/refund_sosmed.php';
#require_once 'autocron/off_depo.php';
require_once 'auth/data_ex.php';
require_once 'autocron/custom/date_at.php';
require_once 'autocron/cancel_depo.php';
// END CUSTOM


/* Required: Provider */
function lannProv($code, $type = 'fetch_assoc') {
    global $db;
  
    if($type == 'fetch_assoc') { 
        return $db->query("SELECT * FROM provider WHERE code = '$code'")->fetch_assoc();
    } else {
        return $db->query("SELECT * FROM provider WHERE code = '$code'");
    }
}

// -- |[ MAINTENANCE CONFIGURATION REQUIRED ]| -- //
if(isset($_SESSION['user']['username']) && $_SESSION['user']['level'] !== 'Admin' && $web['maintenance'] == 'false') {
    require 'layouts/header_mt.php';
    print '<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Hi '.$data_user['name'].'                    
                </div>                
                <div class="card-body">
                	<center> '.$web['reason_mt'].' </center>
                </div>
            </div>
        </div>
    </div>
</div>
';
    require 'layouts/footer.php';
    die();
}

if(preg_match('#Mozilla/4.05 [fr] (Win98; I)#',$user_agent)
    || preg_match('/Java1.1.4/si',$user_agent)
    || preg_match('/MS FrontPage Express/si',$user_agent)
    || preg_match('/HTTrack/si',$user_agent)
    || preg_match('/IDentity/si',$user_agent)
    || preg_match('/HyperBrowser/si',$user_agent)
    || preg_match('/Lynx/si',$user_agent)
) die('Be a Creative Human Dude');