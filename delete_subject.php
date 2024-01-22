<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "time_table";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Failed to connect. Correct something: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $subid = $_GET['id'];

    // Delete subject record
    $delete_query = "DELETE FROM subject WHERE subid = $subid";
    $delete_result = mysqli_query($conn, $delete_query);

    if (!$delete_result) {
        echo "Error deleting subject: " . mysqli_error($conn);
    } else {
        header("Location: subject.php"); // Redirect to the subject management page
    }
}
?>
