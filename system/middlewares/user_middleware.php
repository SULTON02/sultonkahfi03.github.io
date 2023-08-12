<?php
defined("BASEPATH") or exit("No direct script access allowed.");

if (!isset($_SESSION['user'])) {
	exit(header("Location: ".base_url('/home')));
} else {
	$check_user = $db->query("SELECT * FROM users WHERE id = '{$_SESSION['user']['id']}'");
	if (mysqli_num_rows($check_user) == 0) {
		unset($_SESSION['user']);
		exit(header("Location: ".base_url('/home')));
	} else {
		$data_user = $check_user->fetch_assoc();
		$_SESSION['user'] = $data_user;
	}
}
