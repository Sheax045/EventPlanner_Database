<?php
require_once 'database_connect.php';
if(isset($_POST['saved'])) {
    $item = $_POST['item'];
    $quantity = $_POST['quantity'];
    $assigned = $_POST['assigned'];
    $id = $_GET['id'];
    $notes = $_GET['note'];
    if(isset($_GET['note'])){
        $notes = $_GET['note'];
        }
    //if(empty($_POST['itemname']))
    //if($_POST['save'] === '') {
      //  echo "Empty";
    //}
    //else {
        
    //}
   //connect to database
   database();
   global $connect;
   $items = "INSERT INTO inventory(eventid, Item, Quantity, Assigned) VALUES ('$id', '$item', '$quantity', '$assigned')";
  $insertItems = mysqli_query($connect, $items);
  if($insertItems){
      
  }else{
      echo mysqli_error($connect);
  }
      mysqli_close($connect);
}

if(isset($_POST['add'])) {
    $notes = $_POST['note'];
    $id = $_GET['id'];
    $title = $_GET['title'];
    $date = $_GET['date'];
    //if(isset($_GET['note'])){
        //$notes = $_GET['note'];
        //}
    
    
    database();
    global $connect;
    $check = "SELECT * FROM notes WHERE eventid = '$id'";
    $checkingNotes = mysqli_query($connect, $check);
    if(mysqli_num_rows($checkingNotes) >= 1){
        $addNotes = mysqli_query($connect, "UPDATE notes SET Notes = '$notes' WHERE eventid = '$id'");
    
        //This was used to test if the to-do item was deleted successfully
        if($addNotes){
            echo 'To-Do successfully updated';
            header('location: events.php?title='.$title.'&date='.$date.'&id='.$id.'&note='.$notes);
        }
        else{
        echo mysqli_error($connect);
        }
    mysqli_close($connect);

    }
   
    else{
        $add = "INSERT INTO notes(eventid, Notes) VALUES ('$id', '$notes')";
        $insertItems = mysqli_query($connect, $add);
        if($add){
            header('location: events.php?title='.$title.'&date='.$date.'&id='.$id.'&note='.$notes);
      
        }else{
            echo mysqli_error($connect);
        }
        mysqli_close($connect);
    }
}
   
//need to check edit inventory and edit name/date....check the $xxx['xxx'] for each.

 //make so the event page is for newly created events and another page for events that have already been created. 

if(isset($_POST['changes'])){

    //gets 'id' from the todo database list table and sets it to variable $id 
    $title = $_POST['editEventName'];
    $date = $_POST['editEventDate'];
    $id = $_GET['id'];
    $notes = $_POST['note'];
    if(isset($_GET['note'])){
        $notes = $_GET['note'];
        }
    


    //calls database function
    database();

    global $connect;

    //sets variable $item to DELETE FROM list WHERE id = '$id' which will be used in mysql. 


    //connects to database and deletes the the item with the matching id from list table in mysql
    $changes = mysqli_query($connect, "UPDATE events SET name = '$title', date = '$date'  WHERE eventid = '$id'");
    echo $id;
    

    //This was used to test if the to-do item was deleted successfully
    if($changes){
        echo 'To-Do successfully updated';
        header('location: events.php?title='.$title.'&date='.$date.'&id='.$id.'&note='.$notes);
    }
    else{
        echo mysqli_error($connect);
    }
        mysqli_close($connect);
    }


?>
<!--<form method='post' action='create.php'>-->
            

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans+Condensed:300|Roboto|Roboto+Slab&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Event Planner</title>
    <style>
    body {
    font-family: 'Open Sans Condensed', sans-serif;
}

.jumbotron {
    background-color: #353535;
    color: #FFFFFF;
}

.jumbotron h1 {
    text-decoration: underline #284B63;
}

.btn {
    background-color: #284B63;
    margin-right: 2%;
}

.btn:hover{
    background-color: #FFFFFF;
    color:#284B63;
    /*opacity: .95;*/
}

.form-control{
    margin-right: 0;
    border-color: #284B63;
}

h4 {
    text-decoration: underline;
    /*--margin: 4% 0 2% 0;--*/
}

a {
    color: black;
}

a:hover {
    color: #284B63; 
    text-decoration: none;
}

.deleteEvent:hover {
    -webkit-transform: rotate(15deg);
    transform: rotate(15deg);
}

.editIcon:hover {
    -webkit-transform: rotate(15deg);
    transform: rotate(15deg);
}    


    </style>
  </head>
  <body>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">Event Planner</h1>
          <p class="lead">Event Planner is here to help you plan an event more efficiently.</p>
        </div>
    </div>
    <div class="container">
        <div class="row" style="margin-bottom: 4%;">
            <!--Event Name-->
            <div class="col-5">
                <h3 style="display: inline-block; margin-right: 2%;">
                <?php
                require_once 'database_connect.php';
                if(isset($_GET['title'])){
                    echo $_GET['title'];
                    $title = $_GET['title'];
                }
                if(isset($_GET['name'])){
                    echo $_GET['name'];
                    $title = $_GET['name'];
                }

                if(isset($_GET['name'])){
                    echo $_GET['name'];
                    $title = $_GET['name'];
                }
//check these out too...some may not be needed
                ?>
                </h3>
                
            </div>
            <!--Event Date-->    
            <div class="col-5">
                <h3 style="display: inline-block; margin-right: 2%;">
                <?php
                if(isset($_GET['date'])){
                    echo $_GET['date'];
                    $date = $_GET['date'];
                }
                ?>
                </h3><!--Need to add database connect for event name-->
                <input type="image" name="edit" src="img/icons8-edit-property-26.png" class="editIcon" style="width:1em; height:1em; margin-left: 1em; margin-top: .5em;" data-toggle="modal" data-target="#exampleModalCenter">
            </div>
            <!--Back and Save Buttons 
            <form method='post' action='events.php'>-->
            <div class="col-2">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="margin-right: 15%;" onClick="location.href='create.php'">Back</button>
                <!--<button type="save" name="saved" class="btn btn-primary">Save</button>-->
            </div>
            <!--</form>-->
        </div>
        <div class="row">
            <div class="col-7">
                <h4>Inventory</h4>
            </div>
            <!--
            <div class="col-4">
                <h4 style="margin-left: 6%;">Attendance</h4>
            </div>
            -->
        </div>
        <div style="width:60%; display: inline-block;">
            <div class="row">
                <div class="col-6">
                    <h6>Item Name</h4>
                </div>
                <div class="col-2">
                    <h6>Quantity</h4>
                </div>
                <div class="col-2">
                    <h6>Assigned</h4>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php
                    require_once 'database_connect.php';
                    global $connect;
                    database();
                    $id = $_GET['id'];
                    if(isset($_GET['note'])){
                        $notes = $_GET['note'];
                        }
                
                    //$item  = ;
                    $result = mysqli_query($connect, "SELECT ItemID, Item, Quantity, Assigned FROM inventory WHERE eventid = '$id'");
                    //check if there's any data inside the table and if there is 1 or more items, it will fetch and display them
                    if(mysqli_num_rows($result) >= 1){
                        while($row = mysqli_fetch_array($result)){
                            $itemID = $row['ItemID'];
                            $item = $row["Item"];
                            $quant = $row["Quantity"];
                            $assign = $row["Assigned"];
                            
                ?>
                        <!--<li style="list-style: none; display: inline-block;"><a href="#?item=<?php echo $item?>&quant=<?php echo $quant?>&assign=<?php echo $assign?>&id=<?php echo $id?>"><?php echo $item?><?php echo $quant?><?php echo $assign?></a></li>-->
                        <form method="post" action="edit1.php?edit=<?php echo $itemID?>&name=<?php echo $title?>&date=<?php echo $date?>&id=<?php echo $id?>&note=<?php echo $notes?>">
                        <div class="col-6" style="display: inline-block; padding-left: 0;">
                            <div class="input-group input-group-sm mb-3">
                                <input style="list-style: none; display: inline-block;" name="editItem" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" value="<?php echo $item?>">
                            </div>
                        </div> 
                        <div class="col-2" style="display: inline-block;">
                            <div class="input-group input-group-sm mb-3">
                                <input type='number' style="list-style: none; display: inline-block;" name="editQuant" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" value="<?php echo $quant?>">
                            </div>
                        </div> 
                        <div class="col-3" style="display: inline-block;">
                            <div class="input-group input-group-sm mb-3">
                                <input style="list-style: none; display: inline-block;" name="editAssign" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" value="<?php echo $assign?>">
                                <input type="image" name="edit" src="img/icons8-edit-property-26.png" class="editIcon" style="width:1em; height:1em; margin-left: 1em; margin-top: .5em;" data-toggle="modal" data-target="#exampleModalCenter">
                                <a href="delete.php?delete=<?php echo $itemID?>&name=<?php echo $title?>&date=<?php echo $date?>&id=<?php echo $id?>&note=<?php echo $notes?>"><img src="img/icons8-trash-50.png" alt="Delete" class="deleteEvent" style="width:1em; margin-left:1em; display: inline-block;"></a>
                            </div>
                        </div>
                        </form>
            <?php
                    }
                        mysqli_close($connect);
                     }
                    ?>
                 <p style="font-size:.75em;">* To edit an item, just type in the changes you want to make and click the edit icon.</p>   
                </div>
            </div>
            <!--INVENTORY INPUT AND BUTTON-->
            <form method='post' action='#'>
            <div class="row">
                <div class="col-6" style="display: inline-block;">
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" class="form-control" name="item" id="item" aria-label="Small" aria-describedby="inputGroup-sizing-sm" style="width: 100%">
                    </div>
                </div>
                <div class="col-2" style="display: inline-block;">
                    <div class="input-group input-group-sm mb-3">
                        <input type="number" class="form-control" name="quantity" id="quantity" aria-label="Small" aria-describedby="inputGroup-sizing-sm" style="width: 100%">
                    </div>
                </div>
                <div class="col-2" style="display: inline-block;">
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" class="form-control" name="assigned" id="assigned" aria-label="Small" aria-describedby="inputGroup-sizing-sm" style="width: 100%">
                    </div>
                </div>
                <!--INVENTORY BUTTON-->
                <div class="col-4">
                    <input type="submit" name="saved" value="+" id="submitForm" class="btn btn-secondary" style="border-radius: 1em;">
                    <!--Add Button-->  
                </div>
            </div>
            </form>
            
                
            <!--Add Button
            <div class="row">
                <div class="col-2">
                    <img src="img/icons8-add-50.png" alt="Add" style="width:25%; margin-top: 4%;">
                    <!--<button type="button" class="btn btn-primary">Add</button>
                </div>
            </div>-->
            <!--NOTES INPUT AND BUTTON-->
            <!--NEED TO GET NOTES TO SHOW UP AND WORK!!!!-->
            <!--When notes are edited and added, the name disappears. When the Name is edited, the notes disappear. Also, when adjusting inventory items the notes go away. Need to fix.-->

            <?php
            require_once 'database_connect.php';
            if(1==1){
                $notes = $_POST['note'];
                $id = $_GET['id'];
                $title = $_GET['title'];
                $date = $_GET['date'];
                
                database();
                global $connect;
                $currentNotes = "SELECT * FROM notes WHERE eventid = '$id'";
                $checkingNotes = mysqli_query($connect, $currentNotes);
                if(mysqli_num_rows($checkingNotes) >= 1){
                    header('location: events.php?title='.$title.'&date='.$date.'&id='.$id.'&note='.$notes);
                    }
                else{
                    echo mysqli_error($connect);
                    }
                mysqli_close($connect);
            
                }
                ?>
            <div class="row" style="margin-top: 4%;">
                <div class="col-11">
                    <form action="#" method="post">
                        <h6>Notes</h4>
                        <textarea class="form-control" name="note" aria-label="With textarea"><?php require_once 'database_connect.php';
                            if(isset($_GET['note'])){
                                echo $_GET['note'];
                                $notes = $_GET['note'];
                                }
                        ?>
                        </textarea>
                        <p style="font-size:.75em; margin-top:1em;">* To edit the notes section, just type in the changes you want to make and click the Add Notes button.</p>  
                        <input type="submit" name="add" value="Add Notes" class="btn btn-secondary" style="margin-top:1em;">
                    </form>
                </div>
            </div>
        </div>
        <!-----------------------------------------EDIT MODAL--------------------------------------->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Name & Date</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="#" method="post">
                    <div class="modal-body">
                        <input type="text" style="margin-bottom: 2%;" name="editEventName" value="Edit Event Name" class="form-control" id="editEventName" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                        <input class="form-control" type="date" name ="editEventDate" value="mm/dd/yyyy" id="editEventDate" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" name="changes" value="Save changes" class="btn btn-secondary"></a>
                    </div>
                    </form>
                </div> 
            </div>
        </div>
        <!--INPUT FOR ATTENDANCE----
        <div style="width:40%; float: right; padding-left: 2%;">
            <div class="row">
                <div class="col-4">
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" style="width: 50%; margin-bottom: 15%;" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
            </div> 
            -------------------------------STRETCH GOALS-----------------------------
            <div class="row">
                <div class="col-4">
                    <h4>Receipts</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="col-3">
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="col-2">
                    <img src="img/icons8-trash-50.png" alt="Delete" style="width:45%;">
                </div>
            </div>
            <div class="row" style="margin-top: 2%;">
                <div class="col-4">
                    <div class="input-group input-group-sm mb-3" style="margin-top: -1.25em">
                        <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="col-3">
                    <div class="input-group input-group-sm mb-3" style="margin-top: -1.25em">
                        <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="col-2">
                    <img src="img/icons8-trash-50.png" alt="Delete" style="width:45%; margin-top: -2em">
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <img src="img/icons8-add-50.png" alt="Add" style="width:45%; margin-top: 4%; margin-bottom: 40%;">
                </div>
            </div>
            <!--Right side content
            <div class="row">
                <div class="col-6">
                    <h4>Cost Per Individual</h4>
                </div>
            </div>
            <div class="row" style="margin-top: 2%;">
                <div class="col-5">
                    <p>Number of people paying: </p>
                </div>
                <div class="col-3">
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 2%;">
                <div class="col-5">
                    <p>Total Cost Per Person = </p>
                </div>
                <div class="col-3">
                    <p>Javascript calculation here</p>
                </div>
            </div>-->
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
</body>
</html>

