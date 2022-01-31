<?php 

require_once('vendor/phpqrcode/qrlib.php');

 // outputs image directly into browser, as PNG stream
 $qrcode = QRcode::png(get_bloginfo());