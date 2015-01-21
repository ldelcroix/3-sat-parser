<?php

require_once '3-SAT/functions.php';

require_once '3-SAT/init.php';


$handle = fopen($instance_file, 'r'); // Ouverture du fichier en lecture seule

if (!$handle) {
    throw new Exception('Open failed.'); // Si on n'a pas réussi à ouvrir le fichier
}

$lines_nb = 0;

$pos = false;
while (!feof($handle) && $pos === false) {
    
    $buffer = fgets($handle);

    $pos = strpos($buffer, 'p cnf');
}

$params = explode(' ', $buffer);

if(count($params) != 4 || $params[0] != 'p' || $params[1] != 'cnf') {
    throw new Exception('Bad format of instance definition.');
}

$variables_nb = $params[2];
$clauses_nb = $params[3];

$console[] = 'Variables nb : '.$variables_nb;
$console[] = 'Clauses nb : '.$clauses_nb;

$filework_time_start = microtime(true);

require_once '3-SAT/work_in_file.php';

fclose($handle); // On ferme le fichier

$console[] = 'File working time : '.round(microtime(true) - $filework_time_start, 5).' s';

$console[] = 'Download file : <a href="'. $_SERVER["REQUEST_URI"].'&download'.'">download</a>';

/*******************************************************************************/
$additionalwork_time_start = microtime(true);

require_once '3-SAT/work_additionnal.php';

$console[] = 'Additional working time : '.round(microtime(true) - $additionalwork_time_start, 5).' s';
