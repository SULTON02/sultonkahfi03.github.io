<?php
defined("BASEPATH") or exit("No direct script access allowed.");
$_CONFIG = $_CONFIG;

if (!function_exists('e')) {
	function e($data) {
		return htmlspecialchars(trim($data));
	}
}

if (!function_exists('config')) {
	function config($type, $name, $default_value = null) {
		global $_CONFIG;
		return (!empty($_CONFIG[$type][$name])) ? $_CONFIG[$type][$name]:$default_value;
	}
}

if (!function_exists('base_url')) {
	function base_url($to = '/') {
		return config('web', 'url').$to;
	}
}

if (!function_exists('asset')) {
	function asset($to = '/') {
		return config('web', 'assets').$to;
	}
}

if (!function_exists('bulan_indonesia') && !function_exists('tanggal_indonesia')) {
	function bulan_indonesia() {
		return [
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05'=> 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember'
		];
	}

	function tanggal_indonesia($date = null) {
		$timestamps = ($data !== null) ? strtotime($date):strtotime(date("Y-m-d H:i:s"));
		$Y = date("Y", $timestamps);
		$m = date("m", $timestamps);
		$d = date("d", $timestamps);
		$His = date("H:i:s", $timestamps);
		$mIndonesia = bulan_indonesia()[$m];

		return "{$y} {$mIndonesia} {$d}, {$His}";
	}
}

if (!function_exists('random')) {
	function random($length = 10) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		return substr(str_shuffle($chars), 0, $length);
	}
}

if (!function_exists('generate_csrf_token') && !function_exists('verify_csrf_token') && !function_exists('csrf_token')) {
	function generate_csrf_token() {
		$token = random(150);
		$_SESSION['csrf_token'] = $token;
	}

	function verify_csrf_token($token) {
		if ($token !== md5($_SESSION['csrf_token'])) {
			return false;
		}

		return true;
	}

	function csrf_token() {
		return md5($_SESSION['csrf_token']);
	}
}

if (!function_exists('time_elapsed_string')) {
	function time_elapsed_string($datetime, $full = false) {
	    $now = new DateTime;
	    $ago = new DateTime($datetime);
	    $diff = $now->diff($ago);

	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7;

	    $string = array(
	        'y' => 'tahun',
	        'm' => 'bulan',
	        'w' => 'minggu',
	        'd' => 'hari',
	        'h' => 'jam',
	        'i' => 'menit',
	        's' => 'detik',
	    );
	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
	        } else {
	            unset($string[$k]);
	        }
	    }

	    if (!$full) $string = array_slice($string, 0, 1);
	    return $string ? implode(', ', $string) . ' lalu' : 'baru saja';
	}
}

if (!function_exists('gravatar')) {
	function gravatar($email, $size = 1024, $default = "robohash") {
		return "https://www.gravatar.com/avatar/".md5(strtolower(trim($email)))."?d=".$default."&s=".$size."&r=x";
	}
}

if (!function_exists('uri')) {
    function uri($segment = null) {
        $uri = explode('?', ($_SERVER['REQUEST_URI']))[0];
        if ($segment === null) {
            return $uri;
        } else {
            $segments = explode('/', $uri);
            
            return $segments[$segment];
        }
    }
}

function ajaxlib($x) {
    return base_url('admin/ajax/'.$x);
}

function base64($type,$data) {
    if($type == 'encode') return base64_encode($data);
    if($type == 'decode') return base64_decode($data);
    if($type == 'check') return (base64_encode(base64_decode($data)) == $data) ? (!trim(stripslashes(strip_tags(htmlspecialchars(base64_decode($data),ENT_QUOTES))))) ? false : true : false;
    if($type == 'auto') return (base64_encode(base64_decode($data)) == $data) ? (!trim(stripslashes(strip_tags(htmlspecialchars(base64_decode($data),ENT_QUOTES))))) ? base64_encode($data) : $data : base64_encode($data);
    if(!in_array($type,['encode','decode','check','auto'])) return false;
}

function client_ip() {
    if(getenv('HTTP_CLIENT_IP')) { $str = getenv('HTTP_CLIENT_IP'); } 
    else if(getenv('HTTP_X_FORWARDED_FOR')) { $str = getenv('HTTP_X_FORWARDED_FOR'); } 
    else if(getenv('HTTP_X_FORWARDED')) { $str = getenv('HTTP_X_FORWARDED'); } 
    else if(getenv('HTTP_FORWARDED_FOR')) { $str = getenv('HTTP_FORWARDED_FOR'); } 
    else if(getenv('HTTP_FORWARDED')) { $str = getenv('HTTP_FORWARDED'); } 
    else if(getenv('REMOTE_ADDR')) { $str = getenv('REMOTE_ADDR'); } 
    else { $str = 'Unknown'; }
    return explode(',',$str)[0];
}

function client_iploc($ip) {
    // bisa pake ip-api.com juga, tapi dilimit 150/menit
    $url = "http://www.geoplugin.net/php.gp?ip=$ip";
    $get = unserialize(file_get_contents($url));
    return (isset($get['geoplugin_city']) && isset($get['geoplugin_countryCode'])) ? $get['geoplugin_city'].' '.$get['geoplugin_countryCode'] : 'Unknown Place';
}

function get_client_browser() {
    $browser = '';
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape'))
        $browser = 'Netscape';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox'))
        $browser = 'Firefox';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome'))
        $browser = 'Chrome';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera'))
        $browser = 'Opera';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
        $browser = 'Internet Explorer';
    else
        $browser = 'Other';
    return $browser;
}

function redirect($sec,$loc) {
    if($sec == 0 || $sec = '0') {
        return header("Location: $loc");
    } else {
        echo "<meta http-equiv='refresh' content='$sec;url=$loc'>";
    }
}

function visited() {
    global $_SERVER;
    if(isset($_SERVER['REDIRECT_URL'])) {
        return 'https://'.$_SERVER['SERVER_NAME'].$_SERVER['REDIRECT_URL'];
    } else {
        return 'https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    }
}

function devices() {
    global $_SERVER;
    $ua = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$ua)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($ua,0,4))){
        $device = 'Mobile';
    } else {
        $device = 'Desktop';
    }
    return $device;
}

function format_date($lang,$ymd_format) {
    $ymdhis = explode(' ',$ymd_format);
    if($lang == 'id') {
        $month = [
            1 => 'Januari','Februari','Maret','April','Mei','Juni',
            'Juli','Agustus','September','Oktober','November','Desember'
        ];
        $explode = explode('-', $ymdhis[0]);
        $formatted = $explode[2].' '.$month[(int)$explode[1]].' '.$explode[0];
        $format = isset($ymdhis[1]) ? $formatted.' ('.substr($ymdhis[1],0,5).' WIB)' : $formatted;
    } else if($lang == 'en') {
        $month = [
            1 =>   'January','February','March','April','May','June',
            'July','August','September','October','November','December'
        ];
        $explode = explode('-', $ymdhis[0]);
        $formatted = $month[(int)$explode[1]].' '.$explode[2].', '.$explode[0];
        $format = isset($ymdhis[1]) ? $formatted.' ('.substr($ymdhis[1],0,5).' WIB)' : $formatted;
    } else {
        $format = '';
    }
    
    return $format;
}

function filter_phone($type,$number) {
    $phone = preg_replace("/[^0-9]/", '', filter_entities($number));
    if($type == '0') {
        if(substr($phone,0,3) == '+62'){ $change = '0'.substr($phone,3); }
        else if(substr($phone, 0, 2) == '62'){ $change = '0'.substr($phone,2); }
        else if(substr($phone, 0, 1) == '0') { $change = $phone; }
    } else {
        if(substr($phone,0,3) == '+62'){ $change = substr($phone,1); }
        else if(substr($phone, 0, 2) == '62'){ $change = $phone; }
        else if(substr($phone, 0, 1) == '0') { $change = '62'.substr($phone,1); }
    }
    return $change;
}

function remainDay($expired) {
    date_default_timezone_set('Asia/Jakarta');
    $diff = date_diff(date_create(date("Y-m-d")),date_create($expired));
    $day = str_replace('+','',$diff->format("%R%a"));
    if($day <= 0) {
        return ($day == 0) ? 1 : $day;
    } else {
        return $day;
    }
}

function random_number($length) {
    $str = ""; $characters = array_merge(range('0','9'));
    $max = count($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
    }
    return $str;
}

function filter($data) {
    global $db;
    return $db->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)))));
}

function filter_entities($data) {
    global $db;
    return $db>real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars(htmlentities($data,ENT_QUOTES))))));
}
function anti_xss($text)
{
    $text = htmlspecialchars(stripslashes(htmlentities(strip_tags(trim($text)))));
    return $text;
}

function anti_inject($text = null)
{
    if ($text) {
        $filter = false === strpbrk($text, "#$%^&*=';{}|:<>?~") ? true : false;
    } else {
        $filter = false;
    }
    return $filter;
}

function anti_inject_url($text = null)
{
    if ($text) {
        $filter = false === strpbrk($text, "#$^*';{}|<>~") ? true : false;
    } else {
        $filter = false;
    }
    return $filter;
}
function infojson($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $data = curl_exec($ch);
        curl_close($ch);
                return $data;
}


function followers_count($data){
    $id = file_get_contents("https://instagram.com/web/search/topsearch/?query=".$data);
    $id = json_decode($id, true);
    $count = $id['users'][0]['user']['follower_count'];
    return $count;
}

function likes_count($data){
    $id = file_get_contents("".$data."?&__a=1");
    $id = json_decode($id, true);
    $count = $id['graphql']['shortcode_media']['edge_media_preview_like']['count'];
    return $count;
}

function views_count($data){
    $id = file_get_contents("".$data."?&__a=1");
    $id = json_decode($id, true);
    $count = $id['graphql']['shortcode_media']['video_view_count'];
    return $count;
}

function validate_date($date) {
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') == $date;
}

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

function micro_time()
{
    class Timer
    {
        private $timeStart;
        private $microsecondsStart;
        private $timeStop;
        private $microsecondsStop;

        public function __construct()
        {
            $this->start();
        }

        public function start(): void
        {
            [$this->microsecondsStart, $this->timeStart] = explode(' ', microtime());
            $timeStop = null;
            $microsecondsStop = null;
        }

        public function stop(): void
        {
            [$this->microsecondsStop, $this->timeStop] = explode(' ', microtime());
        }

        public function getTime(): float
        {
            $timeEnd = $this->timeStop;
            $microsecondsEnd = $this->microsecondsStop;
            if (!$timeEnd) {
                [$microsecondsEnd, $timeEnd] = explode(' ', microtime());
            }

            $seconds = $timeEnd - $this->timeStart;
            $microseconds = $microsecondsEnd - $this->microsecondsStart;

            // now the integer section ($seconds) should be small enough
            // to allow a float with 6 decimal digits
            return round($seconds + $microseconds, 6);
        }
    }

    $t = new Timer();
    usleep(250);
    return 'Page Load: ' . $t->getTime() . 's.';
}
