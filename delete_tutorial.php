<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "time_table";

// Establish a connection to the database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// // Check if the 'id' GET parameter is set
// if (isset($_GET['id']) && !empty($_GET['id'])) {
//     // Get the tutorial id to delete
//     $tutorial_id = mysqli_real_escape_string($conn, $_GET['id']);

//     // The DELETE statement with a placeholder for the tutorial_id
//     $sql = "DELETE FROM tutorials WHERE tutorial_id = ?";

//     // Prepare the statement
//     if ($stmt = mysqli_prepare($conn, $sql)) {
//         // Bind the tutorial_id parameter to the statement
//         mysqli_stmt_bind_param($stmt, "i", $tutorial_id);

//         // Execute the prepared statement
//         if (mysqli_stmt_execute($stmt)) {
//             echo "Tutorial successfully deleted.";
//         } else {
//             echo "Error deleting tutorial: " . mysqli_error($conn);
//         }

//         // Close the statement
//         mysqli_stmt_close($stmt);
//     } else {
//         echo "Error preparing statement: " . mysqli_error($conn);
//     }
// } else {
//     echo "No tutorial ID provided for deletion.";
// }

// // Close the connection
// mysqli_close($conn);

// // Redirect to the main page (or wherever you wish)
// header("Location: tutorial.php");
// exit();
if (isset($_GET['id'])) {  
    $id = $_GET['id'];  
    $query = "DELETE FROM `tutorial` WHERE id = '$id'";  
    $result = mysqli_query($conn,$query);  
    if ($result) {  
         header('location:index.php');  
    }else{  
         echo "Error: ".mysqli_error($conn);  
    }  
}  
?>
