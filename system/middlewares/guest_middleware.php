<?php
defined("BASEPATH") or exit("No direct script access allowed.");

if (isset($_SESSION['user'])) {
	exit(header("Location: ".base_url()));
}
