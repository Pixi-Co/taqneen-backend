<?php

/*
 * ==========================================================
 * INITIAL CONFIGURATION FILE
 * ==========================================================
 *
 * Insert here the information for the database connection and for other core settings.
 *
 */
 
if (!function_exists("env")) {

    function env($var){
        $env = str_replace("public\supportboard", ".env", __DIR__);
        if ($env == __DIR__) {
            $env = str_replace("public/supportboard", ".env", __DIR__);
        }

        if (file_exists($env)) {

            $content = explode("\n", file_get_contents($env));
            foreach($content as $row) {
                $arr = explode("=", $row);
    
                if (count($arr) > 0) {
                    if ($arr[0] == $var) {
                        return $arr[1];
                    }
                } 
            }
        }
        return null;
    }

}

 
?>
