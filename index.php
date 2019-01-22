<!DOCTYPE html>
<html>
    <head>
        <title>CRUD Sample</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php require_once 'process.php'; ?>
        </br>
        <h3><center>STUDENT INFORMATION</center></h3>
        </br>

        <?php
            $mysqli = new mysqli('127.0.0.1','root','','crud') or die($mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM tbldata")  or die($mysqli->error); //sql query to display all the data in the database
        ?>

        <!-- if clause so we can display an alert message to show that we have
            successfully added, updated and deleted the data.
            MSG_TYPE is the color type of the alert message.
            DANGER is color RED in BOOTSTRAP.
            WARNING is color YELLOW in BOOTSTRAP.
            SUCCESS is color GREEN in BOOTSTRAP. 
            PRIMARY is color BLUE in BOOTSTRAP-->
        <?php 
        if(isset($_SESSION['message'])): ?>          
            <div class="alert alert-<?=$_SESSION['msg_type']?>">
                <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                ?>
            </div>
        <?php endif ?>

    <!-- this form is the SEARCH form that lets the user search data in the database-->
        <form action="index.php" method="POST">
            <div class="col">
                <div class="float-right">
                    <input type="text" class="mb-3" name="search" placeholder="Search..">
                    <input type="submit" class="btn btn-primary" value=">>">
                </div>
            </div>
        </form>
        
        <!-- create a table to display all the data in the database-->
        <div class="container">
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID NUMBER</th>
                        <th>NAME</th>
                        <th>COURSE & YEAR</th>
                        <th colspan="2">ACTION</th>
                    </tr>
                </thead>
                <?php 
                    if(isset($_POST['search'])){
                        $searchq = $_POST['search'];
                        $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
     
                        // use this query to display the search result
                        $result = $mysqli->query("SELECT * FROM tbldata WHERE idno LIKE '%$searchq%' or lname LIKE '%$searchq%' or fname LIKE '%$searchq%' ") or die("unable to search");
                        $count = mysqli_num_rows($result);
     
                        if($count == 0){
                            $output = 'No data found.';
                        }
                        else{              
                            while($row = mysqli_fetch_array($result)): ?>
                            <tr>
                                <td><?php echo $row['idno']; ?></td>
                                <td><?php echo $row['lname'].', '.$row['fname']; ?></td>
                                <td><?php echo $row['course'].' - '.$row['yrlvl']; ?></td>
                                <td></td>
                            </tr>
                            <?php endwhile; ?>
                        <?php
                            } //end of else
                        } //end while     
            
                        // if the search button is not clicked, all data from the database is automatically displayed
                        while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['idno']; ?></td>
                                <td><?php echo $row['lname'].', '.$row['fname']; ?></td>
                                <td><?php echo $row['course'].' - '.$row['yrlvl']; ?></td>
                                <td>
                                    <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a> <!--Creates an edit button for each item-->
                                    <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a> <!--Creates an edit button for each item-->
                                </td> 
                            </tr>
                        <?php endwhile; ?>
            </table>
        </div>

        <!-- Create a form using card to accept and update data into the database -->   
        <div class="row justify-content-center">
        <div class="col-lg-6 m-auto">
        <div class="card border-primary text-center m-auto" style="width: 20rem";>
        <div class="card-body">
        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
            <input type="text" name="idno" class="form-control" 
                    value="<?php echo $idno; ?>" placeholder="ID Number">
            </div>
            <div class="form-group">
            <input type="text" name="lname" class="form-control"
                        value="<?php echo $lname; ?>" placeholder="Lastname">
            </div>
            <div class="form-group">
            <input type="text" name="fname"class="form-control"  
                    value="<?php echo $fname; ?>" placeholder="Firstname">
            </div>
            <div class="form-group">
            <select name="course">
                <option>-- SELECT COURSE --</option>
                <option value="BSCPE">BSCPE</option>
                <option value="BSCRIM">BSCRIM</option>
                <option value="BSED">BSED</option>
                <option value="BSHRM">BSIT</option>
                <option value="BSIT">BSIT</option>
            </select> 
            </div>
            <div class="form-group">
            <select name="yrlvl">
                <option>-- SELECT YEAR LEVEL --</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>        
            </div>
            <div class="form-group">
            <?php //we use if clause to check if the EDIT BUTTON is clicked. If edit button is clicked, the BUTTON will change to UPDATE
            if($update == true):
            ?>
                <button type="submit" class="btn btn-primary btn-block" name="update">Update</button>
            <?php 
            else: ?>
            <button type="submit" class="btn btn-primary btn-block" name="save">Save</button>
            <?php endif; ?>
            </div>
        </form>
        </div>
        <div>
        </div>
    </div>    
    </body>
</html>