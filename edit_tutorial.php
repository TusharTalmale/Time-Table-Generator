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
    $tutorial_id = $_GET['id'];

    // Create a prepared statement
    $query = "SELECT * FROM tutorials WHERE tutorial_id = ?";
    
    // Use a prepared statement to avoid SQL injection
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $tutorial_id); // Assuming 'tutorial_id' is an integer
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if ($result) {
                $tutorial_data = mysqli_fetch_assoc($result);
            } else {
                echo "Error: " . mysqli_error($conn);
                exit;
            }
        } else {
            echo "Error executing prepared statement: " . mysqli_error($conn);
            exit;
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error creating prepared statement: " . mysqli_error($conn);
        exit;
    }
}

if (isset($_POST['update_tutorial'])) {
    $tutorial_id = $_POST['tutorial_id'];
    $tutorial_name = $_POST['tutorial_name'];
    $tutorial_teacher = $_POST['tutorial_teacher'];
    $tutorial_details = $_POST['tutorial_details'];

    // Update tutorial data
    $update_query = "UPDATE tutorials SET tutorial_name = ?, tutorial_teacher = ?, tutorial_details = ? WHERE tutorial_id = ?";
    
    // Use a prepared statement to avoid SQL injection
    if ($stmt = mysqli_prepare($conn, $update_query)) {
        mysqli_stmt_bind_param($stmt, "sssi", $tutorial_name, $tutorial_teacher, $tutorial_details, $tutorial_id);
        
        if (mysqli_stmt_execute($stmt)) {
            header("Location: subject.php"); // Redirect to the tutorial management page
        } else {
            echo "Error updating tutorial: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error creating prepared statement: " . mysqli_error($conn);
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... (your HTML head content) ... -->
</head>
<body>
    <div class="card">
        <form action="#" method="post">
            <header>
                <h1>Edit Tutorial</h1>
            </header>
            <main>
                <div class="input-section">
                    <div class="container">
                        <h3>Tutorial Details</h3>
                        <input type="hidden" name="tutorial_id" value="<?php echo $tutorial_data['tutorial_id']; ?>">
                        <div class="input-group">
                            <label for="tutorial_name">Tutorial Name:</label>
                            <input type="text" id="tutorial_name" name="tutorial_name" value="<?php echo $tutorial_data['tutorial_name']; ?>" required>
                        </div>
                        <div class="input-group">
                            <label for="tutorial_teacher">Tutorial Teacher:</label>
                            <input type="text" id="tutorial_teacher" name="tutorial_teacher" value="<?php echo $tutorial_data['tutorial_teacher']; ?>" required>
                        </div>
                        <div class="input-group">
                            <label for="tutorial_details">Tutorial Details:</label>
                            <input type="text" id="tutorial_details" name="tutorial_details" value="<?php echo $tutorial_data['tutorial_details']; ?>" required>
                        </div>
                        <div class="d-flex">
                            <input type="submit" class="btn btn-success" name="update_tutorial" value="Update Tutorial">
                        </div>
                    </div>
                </div>
            </main>
        </form>
    </div>
</body>
</html>
