<?php


// file name : debug2.php
// Functions for debuging the PHP source code

//function log_debug_value($fname, $lname, $debug_var, $debug_value=0) {}

// Give read, exec for all on directory /debug2_logs
// chmod a+rwx /debug2_logs
// But here you need to open the file in append mode.
// usage : to create new file : log_debug_value(__FILE__, __LINE__, "init app titi", "", "w" );
//         normal : log_debug_value(__FILE__, __LINE__, "init app titi", "");

function log_debug_value($fname, $lname, $debug_var, $debug_value=0, $open_type="a")
{ //append is default

        $fp_debug2 = fopen("C:/www/monsite/logs/monsite.debug.log", $open_type);
        if ($fp_debug2 == false)
        {
                print "<b>File open failed - global.var.inc<b>";
                exit;
        }

        //print "<br> debug_value is : $debug_value <br>";
        if (!$debug_value)
        {
                fwrite($fp_debug2, "\n ". $fname ."  ". $lname .": $debug_var");
        }
        else
        {
                fwrite($fp_debug2, "\n ". $fname . " ". $lname .": $debug_var = $debug_value");
        }
        //print "<br> f_cookie is : $f_cookie <br>";

        fclose($fp_debug2);
}


?>

