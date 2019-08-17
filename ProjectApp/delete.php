<!--this code deletes a to-do list item-->
<?php
//the require_once function is used to include other files to use. In this case it is getting the connectDB.php file.
require_once "database_connect.php";
if(isset($_GET['del'])){

    //gets 'id' from the todo database list table and sets it to variable $id 
    $id = $_GET['del'];
    
    //calls database function
    database();

    global $connect;

//sets variable $item to DELETE FROM list WHERE id = '$id' which will be used in mysql. 
  

     //connects to database and deletes the the item with the matching id from list table in mysql
     $delete = mysqli_query($connect, "DELETE FROM events WHERE eventid = '$id'");
     header('location: create.php');
   
    //This was used to test if the to-do item was deleted successfully
    if($delete){
        echo 'To-Do successfully deleted';
    }
    mysqli_close($connect);
}
if(isset($_GET['delete'])){

    //gets 'id' from the todo database list table and sets it to variable $id 
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

//sets variable $item to DELETE FROM list WHERE id = '$id' which will be used in mysql. 
  

     //connects to database and deletes the the item with the matching id from list table in mysql
     $delete = mysqli_query($connect, "DELETE FROM inventory WHERE ItemID = '$ItemID'");
     echo $ItemID;
   
    //This was used to test if the to-do item was deleted successfully
    if($delete){
        echo 'To-Do successfully deleted';
        header('location: events.php?title='.$title.'&date='.$date.'&id='.$id.'&note='.$notes);
    }
    mysqli_close($connect);
}

?>

