<?php
ob_start();
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $console = array();
            $console[] = '<b>LUDE 3-SAT Console</b>';
            $console[] = '<b>--------------------------</b>';
            $console[] = '';
            $execution_time_start = microtime(true);
            try {
                include_once("3-SAT.php");
            } catch (Exception $e) {
                $console[] = '<span style="color:red">Exception at file <b>'.str_replace(__DIR__,'',$e->getFile()).'</b> in line <b>'.$e->getLine().'</b> : '.$e->getMessage().'</span>';
            }
            $execution_time = microtime(true) - $execution_time_start;
            $console[] = '';
            $console[] = '<b>--------------------------</b>';
            $console[] = '<b>Execution time : '.round($execution_time,5).' s</b>';
        ?>
        <div style="background-color: lightgray; font-family: 'courier new';float:right;top:2px;right:2px;border:1px solid grey;position: fixed;padding:2px;"><?php echo implode("<br>", $console); ?></div>
    </body>
</html><?php
ob_end_flush();