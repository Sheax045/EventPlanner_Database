<!--this code edits an inventory item-->
<?php
//the require_once function is used to include other files to use. In this case it is getting the connectDB.php file.
require_once "database_connect.php";
if(isset($_GET['edit'])){

    //gets 'id' from the todo database list table and sets it to variable $id 
    $ItemID = $_GET['edit'];
    $title = $_GET['name'];
    $date = $_GET['date'];
    $id = $_GET['id'];
    $item = $_POST['editItem'];
    $quant = $_POST['editQuant'];
    $assign = $_POST['editAssign'];
    if(isset($_GET['note'])){
        $notes = $_GET['note'];
        }
    echo $item;

    //calls database function
    database();

    global $connect;

    //sets variable $item to DELETE FROM list WHERE id = '$id' which will be used in mysql. 


    //connects to database and deletes the the item with the matching id from list table in mysql
    $edit = mysqli_query($connect, "UPDATE inventory SET Item = '$item', Quantity = '$quant', Assigned = '$assign'  WHERE ItemID = '$ItemID'");
    echo $id;
    //the below 3 are not showing up.....may need to pass values thru variables or setup like the POST ones when event was created.
    echo $item;
    echo $assign;
    echo $quant;

    //This was used to test if the to-do item was deleted successfully
    if($edit){
        echo 'To-Do successfully deleted';
        header('location: events.php?title='.$title.'&date='.$date.'&id='.$id.'&note='.$notes);
    }
    else{
        echo mysqli_error($connect);
    }
        mysqli_close($connect);
    }

?>