<?php

//start the session
session_start();

//set our connection
$mysqli = new mysqli('127.0.0.1','root','','crud') or die(mysqli_error($mysqli));

//NOTE: there are 2 tables used in 1 database, tbldata => used in index.php and tblsign => used in signup and login 

//we set the id, update, idno, lname, fname, course, yrlvl to empty so the value inside the textfields will be emptied
$id=0;
$update = false;
$idno="";
$lname="";
$fname="";
$course="";
$yrlvl="";

//sql query to insert data into the database
if(isset($_POST['save'])){
    $idno = $_POST['idno'];
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $course = $_POST['course'];
    $yrlvl = $_POST['yrlvl'];

    //check if the fields are empty
    if(empty($_POST['lname']) || empty($_POST['fname']) || empty($_POST['fname']) || empty($_POST['course'])
      || empty($_POST['yrlvl'])){

        $_SESSION['message'] = "Fields can not be empty!";
        $_SESSION['msg_type'] = "danger";
    
        header("location: index.php");  
    }
    else{
      $mysqli->query("INSERT INTO tbldata (idno, lname, fname, course, yrlvl) VALUES('$idno','$lname','$fname','$course','$yrlvl')") or die(mysqli_error($mysqli));
    
      $_SESSION['message'] = "Record has been saved!"; //display a success message if insertion is successful
      $_SESSION['msg_type'] = "success";              //display color SUCCESS or color GREEN in the alert (BOOTSTRAP USED)

      header("location: index.php");                  //route the page back to index.php
  }
}

//sql query to delete the data from the database
if(isset($_GET['delete'])){
  $id = $_GET['delete'];

  $mysqli->query("DELETE FROM tbldata WHERE id=$id") or die($mysqli->error());

  $_SESSION['message'] = "Record has been deleted!"; //display a success message if deletion is successful
  $_SESSION['msg_type'] = "danger";                 //display color DANGER or color RED in the alert (BOOTSTRAP USED)

  header("location: index.php");                    //route the page back to index.php
}


//if EDIT button is clicked, we display the data clicked to the input text fields. UPDATE TRUE means displaying the selected data in the textfield
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM tbldata WHERE id=$id") or die($mysqli->error());
      $row = $result->fetch_array();
      $idno = $row['idno'];
      $lname = $row['lname'];
      $fname = $row['fname'];
      $course = $row['course'];
      $yrlvl = $row['yrlvl'];
}

//when update button is clicked, sql query to update the data from the database
if(isset($_POST['update'])){
  $id = $_POST['id'];
  $idno = $_POST['idno'];
  $lname = $_POST['lname'];
  $fname = $_POST['fname'];
  $course = $_POST['course'];
  $yrlvl = $_POST['yrlvl'];

  $mysqli->query("UPDATE tbldata SET idno='$idno', lname='$lname', fname='$fname',
                 course='$course', yrlvl='$yrlvl' WHERE id=$id") or die($mysqli->error());

  $_SESSION['message'] = "Record has been updated!"; //display a success message if update is successful
  $_SESSION['msg_type'] = "warning";                 //display color WARNING or color YELLOW in the alert (BOOTSTRAP USED)

  header("location: index.php");                    //route the user back to index.php page
}



/////////////////// LOGIN AND SIGNUP FORM //////////////////////////

//check if the login button is pressed
if(isset($_POST['login'])){

    //check if the fields are empty
    if(empty($_POST['signuname']) || empty($_POST['signpass'])){
      $_SESSION['message'] = "Fields can not be empty!";  
      $_SESSION['msg_type'] = "danger";                   

      header("location: login.php");                      
    }
    else{
      $result=$mysqli->query("SELECT * FROM tblsign WHERE signuname='".$_POST['signuname']."' and signpass='".$_POST['signpass']."' ");

      if(mysqli_fetch_assoc($result)){
        header("location: welcome.php"); //after a successfull login, user will be routed to welcome page
      }
      else{
        $_SESSION['message'] = "Username and Password incorrect!";
        $_SESSION['msg_type'] = "danger";    
  
        header("location: login.php");
      }
    }
}

//check when the sign up button is pressed
if(isset($_POST['signup'])){
    $signlname = $_POST['signlname'];
    $signfname = $_POST['signfname'];
    $signemail = $_POST['signemail'];
    $signuname = $_POST['signuname'];
    $signpass = $_POST['signpass'];

    if(empty($_POST['signlname']) || empty($_POST['signfname']) || empty($_POST['signemail']) || empty($_POST['signuname']) || empty($_POST['signpass'])){
      
      $_SESSION['message']="Fields can not be empty!";
      $_SESSION['msg_type']="danger";

      header("location: signup.php");

    }
    else{
      $mysqli->query("INSERT INTO tblsign (signlname, signfname, signemail, signuname, signpass) VALUES 
                    ('$signlname','$signfname','$signemail','$signuname','$signpass')") or die(mysqli_error($mysqli));

      $_SESSION['message']="Successfully signed up";
      $_SESSION['msg_type']="success";

      header("location: signup.php");
    }
}

?>