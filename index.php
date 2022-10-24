

<?php
    // require('./vender/autoload.php');

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    require_once('./mvc/Bridge.php');
    session_start();
    ob_start();
    $myApp = new App();
?>