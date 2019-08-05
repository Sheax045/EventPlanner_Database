<?php
require_once 'database_connect.php';
if(isset($_POST['submit'])) {
   $title = $_POST['eventTitle'];
   $date = $_POST['eventDate'];

   //connect to database
   database();
   global $connect;
   $event = "INSERT INTO events(Name, Date) VALUES ('$title', '$date')";
  $insertEvent = mysqli_query($connect, $event);
  if($insertEvent){
      echo 'successfully';
  }else{
      echo mysqli_error($connect);
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
    background-color: #284B63;
    opacity: .95;
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
    text-decoration: none;
}

.deleteEvent:hover {
    background-color: blue;
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
            
            <div class="col-8">
                <form method='post' action='create.php'>
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
                <table>
                    <tr>
                        <th>Events</th>
                    </tr>
                    <?php
                    require_once 'database_connect.php';
                $sql = 'SELECT Name from events';
                $result = database()-> query($sql);

                if ($result-> num_rows > 0) {
                    while ($row = $result-> fetch_assoc()) {
                        echo '<tr><td><a href="events.html">'. $row['Name'].'</a><a href="delete.php?del=<?php echo $id?>"><img src="img/icons8-trash-50.png" alt="Delete" class="deleteEvent" style="width:20%; margin-left:12%; margin-bottom: 4%;"></a></td></tr>';
                    }
                    echo '</table>';
                }
                else {
                    echo '0 result';
                }
                $connect-> close();
                ?>
                </table>
            </div>
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

