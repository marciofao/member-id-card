<?php 


require_once('vendor/phpqrcode/qrlib.php');
 // outputs image directly into browser, as PNG stream

 QRcode::png(get_home_url()."/?card-view=".$_GET['card-generate']);
