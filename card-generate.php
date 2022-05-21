<?php
error_reporting(E_ALL);
$string = get_home_url()."/?card-view=".$_GET['card-generate'];
//die($string);
require('vendor/phpqrcode/qrlib.php');

QRcode::png('edrftgyhujx');

