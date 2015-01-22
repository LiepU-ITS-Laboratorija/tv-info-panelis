<?php

function read_dir($dir, $array = array())
    {
    $dh = opendir($dir);
    $files = array();
    while (($file = readdir($dh)) !== false)
        {
            $flag = false;
        if($file !== '.' && $file !== '..' && !in_array($file, $array))
        {
            $files[] = $file;
        }
    }
    return $files;
}

