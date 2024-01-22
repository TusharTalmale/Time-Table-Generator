<?php
$servername = "localhost";
$username = "root";
$password ="";

$conn = mysqli_connect($servername,$username,$password,'time_table');

if (!$conn){
    die("Failed to connect correct something".Mysqli_connect_error());
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!-- Include the CSS file -->
    <title>Subject Management</title>
   
</head>
<body>
<!--  Insert Data into Database -->

    <?php
        if (isset($_POST['subadd'])) {
            $subid = $_POST['subid'];
            $subname = $_POST['subname'];
            $sub_teacher = $_POST['sub_teacher'];
            $subdetail = $_POST['subdetail'];

            $query = "INSERT INTO `subject` (`subname`, `subid`, `sub_teacher`, `subdetail`) VALUES ('$subname', '$subid', '$sub_teacher', '$subdetail')";
            $dat = mysqli_query($conn, $query);

            if (!$dat) {
                echo "Error: " . mysqli_error($conn);
            } 
        }

        //show in table
        $query = "SELECT * FROM `subject`";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Error: " . mysqli_error($conn));
        }
        
        if (isset($_POST['delete'])) {
            $id_to_delete = $_POST['id_to_delete'];
            $delete_query = "DELETE FROM subject WHERE id = $id_to_delete";
            mysqli_query($conn, $delete_query);
        }

        $query = "SELECT * FROM subject";
        $result = mysqli_query($conn, $query);
    ?>

<section class="container">
    
    <form action="#" method="post">
        <header>
           <br> <h3 style="padding-top: 15px">Subject Management</h3>
        </header>
        
        
        <div class="left-section">
                    <div class="input-group">
                        <label for="subid">Subject ID:</label>
                        <input type="text" id="subid" name="subid" placeholder="Enter Subject ID" required>
                    </div>
                    <div class="input-group">
                        <label for="subname">Subject Name:</label>
                        <input type="text" id="subname" name="subname" placeholder="Enter Subject Name" required>
                    </div>
                    <div class="input-group">
                        <label for="sub_teacher">Subject Teacher:</label>
                        <input type="text" id="sub_teacher" name="sub_teacher" placeholder="Subject Taught By Teacher" required>
                    </div>
                    <div class="input-group">
                        <label for="subdetail">Subject Details:</label>
                        <input type="text" id="subdetail" name="subdetail" placeholder="Enter Subject Details" required>
                    </div>
                    <div class="d-flex">
                        <input type="submit" class="btn btn-success" name="subadd" value="Add Subject">
                    </div>
        </div>
        
    </form>


 

    <!-- Data showed from Database -->
    <div class="right-section">
    <h3>Subject entered shown here </h3>
    <a href="tt.php" class="button">Generate Time-Table</a>
        <table>
            <tr>
                <th>Subject ID</th>
                <th>Subject Name</th>
                <th>Subject Teacher</th>
                <th>Subject Details</th>
                <th>Actions</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['subid'] . "</td>";
                echo "<td>" . $row['subname'] . "</td>";
                echo "<td>" . $row['sub_teacher'] . "</td>";
                echo "<td>" . $row['subdetail'] . "</td>";
                echo "<td>
                        <a href='edit_subject.php?id={$row['subid']}'>Edit</a>
                        <a href='delete_subject.php?id={$row['subid']}'>Delete</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

</section>


<?php
    if (isset($_POST['tutorialadd'])) {
    $tutorial_id = mysqli_real_escape_string($conn, $_POST['tutorial_id']);
    $tutorial_name = mysqli_real_escape_string($conn, $_POST['tutorial_name']);
    $tutorial_teacher = mysqli_real_escape_string($conn, $_POST['tutorial_teacher']);
    $tutorial_details = mysqli_real_escape_string($conn, $_POST['tutorial_details']);

    $query = "INSERT INTO `tutorials` (`tutorial_id`, `tutorial_name`, `tutorial_teacher`, `tutorial_details`) VALUES ('$tutorial_id', '$tutorial_name', '$tutorial_teacher', '$tutorial_details')";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "Error: " . mysqli_error($conn);
    } 
}
?>

<section class="container">
<form action="#" method="post">
<br>
<h3 style="padding-top: 15px">Tutorial Details</h3>

    <div class="left-section">
                
                    <div class="input-group">
                        <label for="tutorial_id">Tutorial ID:</label>
                        <input type="text" id="tutorial_id" name="tutorial_id" placeholder="Enter Tutorial ID" required>
                    </div>
                    <div class="input-group">
                        <label for="tutorial_name">Tutorial Name:</label>
                        <input type="text" id="tutorial_name" name="tutorial_name" placeholder="Enter Tutorial Name" required>
                    </div>
                    <div class="input-group">
                        <label for="tutorial_teacher">Tutorial Teacher:</label>
                        <input type="text" id="tutorial_teacher" name="tutorial_teacher" placeholder="Enter Tutorial Teacher" required>
                    </div>
                    <div class="input-group">
                        <label for="tutorial_details">Tutorial Details:</label>
                        <input type="text" id="tutorial_details" name="tutorial_details" placeholder="Enter Tutorial Details" required>
                    </div>
                    <div class="d-flex">
                        <input type="submit" class="btn btn-success" name="tutorialadd" value="Add Tutorial">
                    </div>
                </div>
            
        </main>
    </form>
</div>

<?php
// Show Tutorials in a Table
$tutorial_query = "SELECT * FROM `tutorials`"; // Replace 'tutorials' with your table name
$tutorial_result = mysqli_query($conn, $tutorial_query);

if (!$tutorial_result) {
    die("Error: " . mysqli_error($conn));
}

if (isset($_POST['delete_tutorial'])) {
    $id_to_delete = $_POST['id_to_delete'];
    $delete_query = "DELETE FROM tutorials WHERE id = $id_to_delete"; // Replace 'tutorials' with your table name
    mysqli_query($conn, $delete_query);
}

$tutorial_query = "SELECT * FROM tutorials"; // Replace 'tutorials' with your table name
$tutorial_result = mysqli_query($conn, $tutorial_query);
?>

<div class="right-section">
<h3>Tutorial entered shown here </h3>
<a href="tt.php" class="button">Generate Time-Table</a>
    <table>
        <tr>
            <th>Tutorial ID</th>
            <th>Tutorial Name</th>
            <th>Tutorial Teacher</th>
            <th>Tutorial Details</th>
            <th>Actions</th>
        </tr>
        <?php
        while ($tutorial_row = mysqli_fetch_assoc($tutorial_result)) {
            echo "<tr>";
            echo "<td>" . $tutorial_row['tutorial_id'] . "</td>";
            echo "<td>" . $tutorial_row['tutorial_name'] . "</td>";
            echo "<td>" . $tutorial_row['tutorial_teacher'] . "</td>";
            echo "<td>" . $tutorial_row['tutorial_details'] . "</td>";
            echo "<td>
                    <a href='edit_tutorial.php?id={$tutorial_row['tutorial_id']}'>Edit</a>
                    <a href='delete_tutorial.php?id={$tutorial_row['tutorial_id']}'>Delete</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

</section>

</body>
</html>
<style>
.button {
  padding: 10px 20px;
  background-color: #4CAF50; 
  border: none; 
  color: white;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px; 
  margin: 4px 2px;
  transition-duration: 0.4s; 
  cursor: pointer; 
}

.button:hover {
  background-color: white;
  color: black; 
}

  </style>




