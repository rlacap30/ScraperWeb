<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        #header("Location: login.php"); 
    }    
    
    $website_id = $_GET['id'];
    $value = $_GET['value'];
    if($website_id === null || $value === null) {
        header("Location: execute.php"); 
    }
    
    $final_value = $value === '1' ? 0 : 1;
    
    $conn = mysqli_connect("localhost", "lacaprose5bin", "", "my_lacaprose5bin");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $query = "UPDATE Websites SET IsScriptActive = '$final_value' WHERE Id = '$website_id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        header("Location: execute.php"); 
    } else {
        echo '<script type = "text/javascript"> alert("An error has occurred.") </script>';
        header("Location: execute.php"); 
    }
    mysqli_close($conn);
?>