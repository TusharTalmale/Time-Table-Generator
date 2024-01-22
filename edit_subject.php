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

    // Retrieve subject data for the given subject ID
    $query = "SELECT * FROM subject WHERE subid = $subid";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $subject_data = mysqli_fetch_assoc($result);
    } else {
        echo "Error: " . mysqli_error($conn);
        exit;
    }
}

if (isset($_POST['update_subject'])) {
    $subid = $_POST['subid'];
    $subname = $_POST['subname'];
    $sub_teacher = $_POST['sub_teacher'];
    $subdetail = $_POST['subdetail'];

    // Update the subject data
    $update_query = "UPDATE subject SET subname = '$subname', sub_teacher = '$sub_teacher', subdetail = '$subdetail' WHERE subid = $subid";
    $update_result = mysqli_query($conn, $update_query);

    if (!$update_result) {
        echo "Error updating subject: " . mysqli_error($conn);
    } else {
        header("Location: subject.php"); // Redirect to the subject management page
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css"> <!-- Include the CSS file -->
    <title>Edit Subject</title>
</head>
<body>
<div class="card">

    <form action="#" method="post">
        <header>
            <h1>Edit Subject</h1>
        </header>
        <main>
            <div class="input-section">
                <div class="container">
                    <h3>Subject Details</h3>
                    <input type="hidden" name="subid" value="<?php echo $subject_data['subid']; ?>">
                    <div class="input-group">
                        <label for="subname">Subject Name:</label>
                        <input type="text" id="subname" name="subname" value="<?php echo $subject_data['subname']; ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="sub_teacher">Subject Teacher:</label>
                        <input type="text" id="sub_teacher" name="sub_teacher" value="<?php echo $subject_data['sub_teacher']; ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="subdetail">Subject Details:</label>
                        <input type="text" id="subdetail" name="subdetail" value="<?php echo $subject_data['subdetail']; ?>" required>
                    </div>
                    <div class="d-flex">
                        <input type="submit" class="btn btn-success" name="update_subject" value="Update Subject">
                    </div>
                </div>
            </div>
        </main>
    </form>
</div>
</body>
</html>
