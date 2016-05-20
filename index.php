<?php

header('Content-type: text/html; charset=utf-8');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Elei&#231;&#227;o Virtual para o Conselho Estadual de Pol&#237;ticas Culturais - RJ</title>
        <link rel="stylesheet" href="css/css.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="screen" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:700' rel='stylesheet' type='text/css'/>
        <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/jquery.maskedinput.js"></script>
        <script type="text/javascript" src="js/js.js"></script>
    </head>
    <body >

        <!-- structure -->
        <div  class="row">

            <!-- left column -->
            <div class="col-xs-5 col-md-3 col-md-offset-1">

                <!-- menu jornal -->

                <?php
                $urltpm = '';
                if (isset($_GET['url'])) {
                    $urltpm = $_GET['url'];
                }
                $_GET['url'] = 'index/menu';
                $_GET['a'] = 'a';

                include './index2.php';
                ?>
                <!-- /menu jornal -->


            </div>
            <!-- /left column -->

            <!-- right column -->
            <div class="col-xs-11 col-md-7">

                    <?php
                    $_GET['url'] = $urltpm;
                    $_GET['a'] = 'aa';
                    include './index2.php';
                    ?>

            </div>

        </div>
        <!-- /structure -->

    </body>
</html>