<?php

if($download){   
   
    $out_filename = $_GET["instance"] . "_optimized";

    if($sort) {
        $out_filename .= "_sorted";
    }

    $out_filename .= ".txt";  

    header("content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=".$out_filename);
    header("content-type: text/plain");
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    ob_end_clean();
    
    $temp_filename = 'temp/'.md5($out_filename.time().microtime()).'.txt';
    $out_file = fopen($temp_filename, "w");
    
    fwrite($out_file, 'p cnf '.$variables_nb.' '.$clauses_nb."\r\n");
    
    for($i = 1; $i <= $variables_nb; $i++) {
        
        //fwrite($out_file, 'c variable '.$i.' clauses '.count($map[$i])."\r\n");
        
        fwrite($out_file, implode("\r\n", $map[$i])."\r\n");
    }

    fclose($out_file);
    
    readfile($temp_filename);
    
    unlink ($temp_filename);
    
    exit();
}

if($print) {
    echo '<h2>p cnf '.$variables_nb.' '.$clauses_nb.'</h2>';
}

$clauses_sum = 0;
$dependencies_sum = 0;

for($i = 1; $i <= $variables_nb; $i++) {
    $clauses_sum += count($map[$i]);
    $dependencies_sum += count($dependencies[$i]);
    
    if($print) {
        echo 'c variable '.$i .' clauses ' .count($map[$i]). ' dependencies '.count($dependencies[$i]);
        asort($dependencies[$i]);
        echo '<ul><li>Dependencies : ' . implode(' ', $dependencies[$i]).'</li></ul>';
        echo '<ul><li>' . implode('</li><li>', $map[$i]).'</li></ul>';
    }
}

$console[] = 'Variables clauses sum : '. $clauses_sum;
$console[] = 'Variables clauses average : '. round($clauses_sum / $variables_nb, 2);
$console[] = 'Variables dependencies average : '. round($dependencies_sum / $variables_nb, 2);