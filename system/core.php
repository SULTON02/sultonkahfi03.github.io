<?php
defined("BASEPATH") or exit("No direct script access allowed.");
require_once BASEPATH.'helpers/default_helper.php';
require_once BASEPATH.'database.php';
require_once BASEPATH.'class/GojekPay.php';

if (!function_exists('load')) {
	function load($type, $name) {
		global $db;
		if ($type == 'helper') {
			$location = BASEPATH.'helpers/'.$name.'_helper.php';
		} else if ($type == 'middleware') {
			$location = BASEPATH.'middlewares/'.$name.'_middleware.php';
		} else {
			return die("Type [{$type}] not found.");
		}

		return (file_exists($location)) ? require_once($location):die(ucfirst("{$type} [{$name}] not found."));
	}
}

date_default_timezone_set(config('web', 'timezone'));
error_reporting((config('web', 'environment') == 'development') ? E_ALL:0);
ini_set("display_errors", (config('web', 'environment') == 'development') ? 1:0);
if (!isset($_SESSION['csrf_token'])) generate_csrf_token();
if (isset($_SESSION['user'])) { $session = $_SESSION['user']['username']; }
function LannRed($red) { return '<font color="red"><pre>'.$red.'</pre></font>'; }
function LannGreen($green) { return '<font color="green"><pre>'.$green.'</pre></font>'; } 
$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'unknown';