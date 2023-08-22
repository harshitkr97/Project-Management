<?php
    session_start();
    if(isset($_SESSION['email']))
    {
            include('../includes/connection.php');
            if(isset($_POST['create_task'])){
                $query = "insert into tasks values(null,$_POST[id],'$_POST[description]','$_POST[start_date]','$_POST[end_date]','Not Started')";
                $query_run = mysqli_query($connection,$query);
                if($query_run){
                    echo"<script type='text/javascript'>
                    alert('Task created successfully....');
                    window.location.href = 'admin_dashboard.php';
                    </script>
                    ";
                }
                else{
                    echo"<script type='text/javascript'>
                    alert('Error... pls try again');
                    window.location.href = 'admin_dashboard.php';
                    </script>
                    ";
                }
            }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin dashboard </title>
            <!-- jQuery file -->

            <script src="../includes/juqery_latest.js"></script>

            <!-- bootstrap file -->
            <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
            <script src="../bootstrap/js/bootstrap.min.js"></script> 

            <!-- External css file -->
            <link rel="stylesheet" type="text/css" href="../css/style.css">

            <!-- jquery code -->

            <!-- create task jquery code -->

            <script type="text/javascript">
                $(document).ready(function(){
                    $("#create_task").click(function(){
                        $("#right_sidebar").load("create_task.php");
                    });
                });

                // manage task jquery code

                $(document).ready(function(){
                    $("#manage_task").click(function(){
                        $("#right_sidebar").load("manage_task.php");
                    });
                });

                $(document).ready(function(){
                    $("#view_leave").click(function(){
                        $("#right_sidebar").load("view_leave.php");
                    });
                });
            </script>


        </head>
        <body>
            <!-- header start -->
            <div class="row" id="header">
                <div class="col-md-12">
                    <div class="col-md-4" style="display: inline-block;">
                        <h3>Task Management System</h3>
                    </div>
                    <div class="col-md-6"style="display: inline-block; text-align: right;">
                        <b>Email:</b><?php echo $_SESSION['email']; ?>
                        <span style="margin-Left: 25px;"><b>Name: </b><?php echo $_SESSION['name']; ?></span>
                    </div>
                </div>

            </div>
            <!-- header end -->
            <div class="row">
                <div class="col-md-2" id="left_sidebar">
                        <table class="table">
                            <tr>
                                <td style="text-align: center;">
                                    <a href="admin_dashboard.php"type ="button" id="logout_link">Dashboard</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    <a type ="button" id="create_task">Create task</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    <a type ="button" id="manage_task">Manage task</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    <a type ="button" id ="view_leave">Leave applications</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    <a href="../logout.php"type ="button" id="logout_link">Logout</a>
                                </td>
                            </tr>
                            

                        </table>
                </div>
                <div class="col-md-10" id="right_sidebar">
                        <h4>Instructions for Admin</h4>
                        <ul>
                            <li>1. All the employee should mark their attendence daily.</li>
                            <li>2. Everyone must complete the task assigned to them.</li>
                            <li>3. Kindly maintain decorum of the office.</li>
                            <li>4. keep office and your area neat and clean.</li>
                        </ul>
                </div>
            </div>
        </body>
        </html>
        <?php
    }
    else{
        header('Location:admin_login.php');
    }