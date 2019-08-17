<?php
function database(){
    global $connect;
    $connect = mysqli_connect('localhost', 'root', 'root', 'eventplanner') or     
    die('couldn’t connect to database');
    return $connect;
}

//if(database()){
    //echo 'wawu !!! I’m connected';
//}
?>