<?php
    include('includes/connection.php');
    if(isset($_SESSION['email']))
    {
            if(isset($_POST['update'])){
            $query = "update tasks set status = '$_POST[status]' where tid = $_GET[id]";
            $query_run = mysqli_query($connection,$query);

                if($query_run){
                    echo "<script type='text/javascript'>
                    alert('Status updated successfully....');
                    window.location.href = 'user_dashboard.php';
                    </script>";
                }
                else{
                    echo "<script type='text/javascript'>
                    alert('Error... pls try again');
                    window.location.href = 'user_dashboard.php';
                    </script>";
                }
                
                // Close the prepared statement
                mysqli_stmt_close($stmt);
            }
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update</title>
            <!-- jQuery file -->

            <script src="includes/juqery_latest.js"></script>

            <!-- bootstrap file -->
            <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
            <script src="bootstrap/js/bootstrap.min.js"></script> 

            <!-- External css file -->
            <link rel="stylesheet" type="text/css" href="css/style.css">
        </head>
        <body>
            <!-- header code starts here -->
            <div class="row" id="header">
                <div class="col-md-12">
                    <h3><i class="fa fa-solid fa-list" style="padding-right: 15px;"></i>Task Management System</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 m-auto" style="color:white;"><br>
                    <h3 style = "color: white;">Update the task</h3><br>
                    <?php
                        $query = "select * from tasks where tid = $_GET[id]";
                        $query_run = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_assoc($query_run)){
                            ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <input type="hidden" name="id" class="form-control" value="" required>
                            </div>
                            <div class="form-group">
                                <select name="status" class="form-control">
                                    <option>-Select-</option>
                                    <option>In-Progress</option>
                                    <option>complete</option>
                                </select>
                                
                            </div>
                            <input type="submit" class="btn btn-warning" name="update" value="update">

                        </form>
                        <?php
                        }
                    ?>
                </div>
            </div>
        </body>
        </html>
        <?php
    }
    else{
        header('Location:user_login.php');
    }