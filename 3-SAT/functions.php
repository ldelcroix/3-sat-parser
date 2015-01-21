<?php

function ends_with($haystack, $needle) {
    return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
}

function lude_cmp($a, $b) {
    $a_safe = str_replace('-', '', $a);
    $b_safe = str_replace('-', '', $b);
    
    if ($a_safe == $b_safe) {
        return 0;
    }
    return ($a_safe < $b_safe) ? -1 : 1;
}

function instances_options() {
    $return = '';
    
    $instances = array();
    
    foreach (glob("instances/*.cnf") as $filename) {        
        $instances[] = (int) str_replace('.cnf','',str_replace('instances/','',$filename));
    }
    
    sort($instances);
    
    foreach ($instances as $instance) {                        
        $return .= '<option value="'.$instance.'">'.$instance.' ('.filesize('instances/'.$instance.'.cnf').' bytes)</option>';
    }
    
    return $return;
}