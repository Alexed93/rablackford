<?php

// definition for getting theme components and passing variables if required
// function name: liv_get_component( file, args )

function rab_get_component($file, $args = []) {

    $file_path = sprintf("/components/%s/index.php", $file);
    $component_path = locate_template($file_path);

    if (!file_exists($component_path)) {
        echo 'Component "'. $file .'" does not exist at '. $file_path;
        return false;
    }

    include $component_path;
}
