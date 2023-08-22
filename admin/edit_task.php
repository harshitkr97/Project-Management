<?php
    include('../includes/connection.php');
    if(isset($_POST['edit_task'])){
        // Validate and sanitize input data
        $uid = intval($_POST['id']);
        $description = mysqli_real_escape_string($connection, $_POST['description']);
        $start_date = mysqli_real_escape_string($connection, $_POST['start_date']);
        $end_date = mysqli_real_escape_string($connection, $_POST['end_date']);
        $tid = intval($_GET['id']);

        // Use prepared statements to prevent SQL injection
        $query = "UPDATE tasks SET uid = ?, description = ?, start_date = ?, end_date = ? WHERE tid = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "isssi", $uid, $description, $start_date, $end_date, $tid);

        // Execute the statement
        $query_run = mysqli_stmt_execute($stmt);

        if($query_run){
            echo "<script type='text/javascript'>
            alert('Task updated successfully....');
            window.location.href = 'admin_dashboard.php';
            </script>";
        }
        else{
            echo "<script type='text/javascript'>
            alert('Error... pls try again');
            window.location.href = 'admin_dashboard.php';
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
    <title>ETMS</title>
     <!-- jQuery file -->

     <script src="../includes/juqery_latest.js"></script>

    <!-- bootstrap file -->
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script> 

    <!-- External css file -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
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
            <h3 style = "color: white;">Edit the task</h3><br>
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
                        <label for="">Select user:</label>
                        <select class="form-control" name="id" required> 
                                <option>-Select-</option>
                                <?php
                                    $query1 = "select uid,name from users";
                                    $query_run1 = mysqli_query($connection,$query1);
                                    if(mysqli_num_rows($query_run1)){
                                        while($row1 = mysqli_fetch_assoc($query_run1)){
                                            ?>
                                            <option value="<?php echo $row1['uid'];?>"><?php echo $row1['name']; ?></option>
                                            <?php
                                        }
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <textarea class="form-control" rows="3" cols="50" name="description" required><?php echo $row['description'];?></textarea>

                    </div>
                    <div class="form-group">
                        <label>Start date:</label>
                        <input type="date" class="form-control" name="start_date" value="<?php echo $row['start_date']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>End date:</label>
                        <input type="date" class="form-control" name="end_date" value="<?php echo $row['end_date']; ?>" required>
                    </div>
                    <input type="submit" class="btn btn-warning" name="edit_task" value="update">

                </form>
                <?php
                }
            ?>
        </div>
    </div>
</body>
</html>