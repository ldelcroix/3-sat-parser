<?php

$map = array_fill(1, $variables_nb, array());
$dependencies = array_fill(1, $variables_nb, array());

while (!feof($handle)) {

    $string = trim(fgets($handle));
    
    $string = trim(str_replace(' 0', '', $string));
    
    $values = explode(' ', $string);
    
    if(count($values) > 3)
        throw new Exception('Is not a 3-SAT problem.');
    
    if($sort) {
        usort($values, 'lude_cmp');
    }
    
    $string = implode(' ', $values);
    
    foreach ($values as $value) {
        
        $valueUnsigned = str_replace('-', '', $value);
        
        $map[str_replace('-', '', $valueUnsigned)][] = $string;
        
        foreach ($values as $subvalue) {
            
            $subvalueUnsigned = str_replace('-', '', $subvalue);
            
            if($subvalueUnsigned != $valueUnsigned && !isset($dependencies[$valueUnsigned][$subvalueUnsigned])) {
                $dependencies[$valueUnsigned][$subvalueUnsigned] = $subvalueUnsigned;
            }
        }
    }
}

if(isset($map[""])){
    unset($map[""]);
}