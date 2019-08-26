<!--this code deletes an inventory item-->
<?php
//the require_once function is used to include other files to use. In this case it is getting the database_connect.php file.
require_once "database_connect.php";
if(isset($_GET['del'])){

    $id = $_GET['del'];
    
    //calls database function
    database();

    global $connect;

     //connects to database and deletes the the event with the matching id from events table in mysql
     $delete = mysqli_query($connect, "DELETE FROM events WHERE eventid = '$id'");
     //redirects to create.php page
     header('location: create.php');
   
    //This was used to test if the event was deleted successfully
    if($delete){
        echo 'Event successfully deleted';
    }
    mysqli_close($connect);
}
//this deletes an inventory item
if(isset($_GET['delete'])){

    $ItemID = $_GET['delete'];
    $title = $_GET['name'];
    $date = $_GET['date'];
    $id = $_GET['id'];
    if(isset($_GET['note'])){
        $notes = $_GET['note'];
        }

    //calls database function
    database();

    global $connect;

     //connects to database and deletes the inventory item with the matching id from events table in mysql
     $delete = mysqli_query($connect, "DELETE FROM inventory WHERE ItemID = '$ItemID'");
   
    //This was used to test if the item was deleted successfully
    if($delete){
        echo 'Item successfully deleted';
        //redirects to events.php page
        header('location: events.php?title='.$title.'&date='.$date.'&id='.$id.'&note='.$notes);
    }
    mysqli_close($connect);
}

?>

