<?php

function myErrorHandler($code, $message, $file, $line) {
    if($code == E_ERROR){
        header('Location: error.php');
    } else {
        echo $message;
        exit(1);
    }
}

function fatalErrorShutdownHandler(){
    $last_error = error_get_last();
    if($last_error['type'] === E_ERROR){
        myErrorHandler(E_ERROR, $last_error['message'], $last_error['file'], $last_error['line']);
    }
}

ini_set('display_errors', 'off');
register_shutdown_function("fatalErrorShutdownHandler");
set_error_handler("myErrorHandler");