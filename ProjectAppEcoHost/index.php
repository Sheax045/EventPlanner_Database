<!--this code deletes an event-->
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
     
     //redirects to index.php page
     //header('location: index.php');
   
    //This was used to test if the event was deleted successfully
    if($delete){
        $url = 'index.php?title='.$title.'&date='.$date.'&id='.$id.'&note='.$notes;
    }
    mysqli_close($connect);
}
?>
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
    <title>Event Planner - Event</title>
    <style>
        body {
    font-family: 'Open Sans Condensed', sans-serif;
}

/*---FONTS---*/
/*font-family: 'Roboto', sans-serif;
font-family: 'Montserrat', sans-serif;
font-family: 'Roboto Slab', serif;
font-family: 'Open Sans Condensed', sans-serif;*/


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
}

.form-control{
    margin-right: 2%;
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
    text-decoration: ;
}

.deleteEvent:hover {
    -webkit-transform: rotate(15deg);
    transform: rotate(15deg);
}

.editEvent:hover {
    -webkit-transform: rotate(15deg);
    transform: rotate(15deg);
}

li:first-child{
    margin-top: 1em;
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
        <div class="row">
        <?php
        require_once 'database_connect.php';
        if(isset($_POST['submit'])) {
            $title = $_POST['eventTitle'];
            $date = $_POST['eventDate'];

            //connect to database
            database();
            global $connect;
        //check if duplicate
            $resultset_1 = mysqli_query($connect, "SELECT * FROM events WHERE name ='$title'");
            $count = mysqli_num_rows($resultset_1);
            if($count == 0){
                $event = "INSERT INTO events(name, date) VALUES ('$title', '$date')";
                $insertEvent = mysqli_query($connect, $event);
            }
            else{
            echo '<h6 style="color: red;">*This event already exists, please enter a valid event name.<h6>';
            }
            mysqli_close($connect);
        }
        ?>
        </div>
        <div class="row">
            <div class="col-8">
                <form method='post' action='index.php'>
                <div class="input-group input-group-lg">
                <button type="submit" name='submit' class="btn btn-dark btn-lg">Create</button>
                    <input type="text" id="eventTitle" name="eventTitle" value="Event Name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                </div>
            </div>
            <div class="col-4">
                <div class="input-group input-group-lg">
                    <input class="form-control" type="date" value="Date" id="eventDate" name="eventDate" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                </div>
            </div>
            </form>
        </div>
        <div class="row">
            <div class="col">
                    <?php
                    database();
                    global $connect;
                    //$item  = ;
                    $result = mysqli_query($connect, "SELECT eventid, name, date FROM events");
                    //check if there's any data inside the events table and if there is 1 or more items, it will fetch and display them
                    if(mysqli_num_rows($result) >= 1){
                        while($row = mysqli_fetch_array($result)){
                            $id = $row["eventid"];
                            $title = $row["name"];
                            $date = $row["date"];

                    //this gets the Notes from the notes table
                    $noteResults = mysqli_query($connect, "SELECT Notes FROM notes WHERE eventid = '$id'");
                    if(mysqli_num_rows($noteResults) >= 1){
                        while($row = mysqli_fetch_array($noteResults)){
                            $notes = $row["Notes"];

                                }
                            }
                        ?>
                <ul>
                    <li style="list-style: none; display: inline-block;"><a href="events.php?title=<?php echo $title?>&date=<?php echo $date?>&id=<?php echo $id?>&note=<?php echo $notes?>"><?php echo $title?></a></li>
                    <a href="index.php?del=<?php echo $id?>"><img src="img/icons8-trash-50.png" alt="Delete" class="deleteEvent" style="width:1em; margin-left:1em; display: inline-block;"></a>
                </ul>
            
            <?php
                                
                }
                mysqli_close($connect);
            }
                    ?>
            </div>
        </div>    
    </div>

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

