<?php
function database(){
    global $connect;
    $connect = mysqli_connect('shareddb-q.hosting.stackcp.net', 'eventplanner-313137515a', 'Soccer08', 'eventplanner-313137515a') or 
    //****THE CONNECTION BELOW WAS FOR AWS BUT I SWITCHED TO ECO WEB HOSTING****/
    //$connect = mysqli_connect('admin.cdmcmhwt7rhs.us-east-2.rds.amazonaws.com', 'admin', 'Soccer08', 'eventplanner') or     
    die('couldn’t connect to database');
    return $connect;
}
//TEST TO SEE IF DATABASE CONNECTS
//if(database()){
    //echo 'CONNECTED';
//}
?>
