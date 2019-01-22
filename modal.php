<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>  
</head>
<body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="form-group mt-4">
          <h3>STUDENT CONTACT INFORMATION<h3>        
          <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleModal" name="add">
                      ADD CONTACT</button>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="process.php" method="POST">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">ADD CONTACT DETAILS</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <div class="modal-body">
            <label>Contact Name</label>
            <div class="form-group">
                <input type="text" class="form-control" name="yourname">
            </div>
            <label>Contact Number</label>
            <div class="form-group">
                <input type="text" class="form-control" name="yournum">
            </div>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" name="add">ADD</button>
          </div>
        </div>
      </div>
    </form>  
    </div>

</body>
</html>