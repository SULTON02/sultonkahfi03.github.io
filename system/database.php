<?php
defined("BASEPATH") or exit("No direct script access allowed.");
$database = $_CONFIG['db'];
$db = mysqli_connect($database['host'], $database['username'], $database['password'], $database['name']);
if (!$db) {
	die("Cannot dbect to database!");
}