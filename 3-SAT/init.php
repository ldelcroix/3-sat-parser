<?php

$console[] = 'Instance choice : <form method="GET" action="" style="display:inline;"><select name="instance">'.instances_options().'</select><input type="submit" /></form>';

if (!isset($_GET['instance'])) {
    throw new Exception('$_GET["instance"] is not set.');
}

if (empty($_GET['instance'])) {
    throw new Exception('$_GET["instance"] is empty.');
}

if ($_GET['instance'] !== strip_tags($_GET['instance'])) {
    throw new Exception('$_GET["instance"] contains invalid characters.');
}

$instance_file = 'instances/' . $_GET["instance"] . '.cnf';

if (!file_exists($instance_file)) {
    throw new Exception('The file <b>' . $instance_file . '</b> doesn\'t exist.');
}

$console[] = 'Instance file : '.$_GET["instance"] . '.cnf';

$sort = isset($_GET['sort']);

$console[] = 'Sort variables : '.($sort ? 'true' : 'false').' <a href="'.($sort ? str_replace('&sort', '', $_SERVER["REQUEST_URI"]) : $_SERVER["REQUEST_URI"].'&sort').'">inverse</a>';

$print = isset($_GET['print']);

$console[] = 'Print results : '.($print ? 'true' : 'false').' <a href="'.($print ? str_replace('&print', '', $_SERVER["REQUEST_URI"]) : $_SERVER["REQUEST_URI"].'&print').'">inverse</a>';

$download = isset($_GET['download']);