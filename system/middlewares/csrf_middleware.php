<?php
defined("BASEPATH") or exit("No direct script access allowed.");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$csrf_token = e(@$_POST['csrf_token']);
	if (!$csrf_token) {
		http_response_code(419);
		die("Page expired.");
	} else if (verify_csrf_token($csrf_token) === false) {
		http_response_code(419);
		die("Page expired.");
	} else {
		generate_csrf_token();
	}
}
