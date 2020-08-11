<?php

// returns the contents of an svg

function rab_get_svg($file)
{
    $file_path = trailingslashit(get_stylesheet_directory()) . $file . '.svg';

    if(!file_exists($file_path)) {
        echo 'SVG "'. $file .'" does not exist at '. $file_path;
        return false;
    }

    echo file_get_contents($file_path);
}
