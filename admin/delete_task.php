<?php
    include('../includes/connection.php');
    $query = "delete from tasks where tid = $_GET[id]";
    $query_run = mysqli_query($connection,$query);
    if($query_run){
        echo "<script type='text/javascript'>
            alert('Task Deleted successfully....');
            window.location.href = 'admin_dashboard.php';
            </script>
            ";
    }
    else{
        echo"<script type='text/javascript'>
            alert('Error .... pls try again');
            window.location.href = 'admin_dashboard.php';
            </script>
            ";
    }
?>