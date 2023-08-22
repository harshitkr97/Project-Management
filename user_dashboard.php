<?php
    session_start();
    if(isset($_SESSION['email']))
    {
            include('includes/connection.php');
            if(isset($_POST['submit_leave'])){
                $query = "insert into leaves values(null,$_SESSION[uid],'$_POST[subject]','$_POST[message]','No Action')";
                $query_run = mysqli_query($connection,$query);
                if($query_run){
                    echo"<script type='text/javascript'>
                    alert('Leave applied successfully....');
                    window.location.href = 'user_dashboard.php';
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
            <title>User dashboard </title>
            <!-- jQuery file -->

            <script src="includes/juqery_latest.js"></script>

            <!-- bootstrap file -->
            <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
            <script src="bootstrap/js/bootstrap.min.js"></script> 

            <!-- External css file -->
            <link rel="stylesheet" type="text/css" href="css/style.css">

            <script type="text/javascript">
                $(document).ready(function(){
                    $("#manage_task").click(function(){
                        $("#right_sidebar").load("task.php");
                    });
                });

                $(document).ready(function(){
                    $("#apply_leave").click(function(){
                        $("#right_sidebar").load("leaveForm.php");
                    });
                });

                $(document).ready(function(){
                    $("#leave_status").click(function(){
                        $("#right_sidebar").load("leave_status.php");
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
                        <b>Email:</b> <?php echo $_SESSION['email']; ?>
                        <span style="margin-Left: 25px;"><b>Name:<?php echo $_SESSION['name']; ?> </b></span>
                    </div>
                </div>

            </div>
            <!-- header end -->
            <div class="row">
                <div class="col-md-2" id="left_sidebar">
                        <table class="table">
                            <tr>
                                <td style="text-align: center;">
                                    <a href="user_dashboard.php"type ="button" id="logout_link">Dashboard</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    <a type ="button" id="manage_task">Update task</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    <a type ="button" id="apply_leave">Apply leave</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    <a type ="button" id="leave_status">Leave status</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    <a href="logout.php"type ="button" id="logout_link">Logout</a>
                                </td>
                            </tr>
                            

                        </table>
                </div>
                <div class="col-md-10" id="right_sidebar">
                        <h4>Instructions for Employees</h4>
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
        header('Location:user_login.php');
    }