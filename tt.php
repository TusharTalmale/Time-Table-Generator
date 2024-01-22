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
<html>
<head>
    <title>Timetable</title>
    <style>
    
body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
    text-align: center;
     font-family:'bonbon',cursive;
}

h1 {
    background-color: #007BFF;
    color: #fff;
    padding: 20px;
    margin: 0;
}
.basic {
margin-left:20px;
text-align: left;
}


table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    border: 5px solid #ddd;
   
}

th {

    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
    background-color: lightgray;
}

td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
    
   
}


.lecture {
    background-color: #A8D9FF;
}

.short-break {
    background-color: #B2B2B2;
}


.club-activity {
    background-color: #FFA07A;
    color: #fff;
}

</style>

</head>
<body>
    <h3>Weekly Timetable</h3>
<div class="basic">
    <?php
        $column1_name = "subname";
        $column2_name = "sub_teacher";
        $table_name = "subject";

        $sql = "SELECT $column1_name, $column2_name FROM $table_name";
        $result = $conn->query($sql);
        if ($result) {
            $teachers = array();
            $subjects = array();

            while ($row = $result->fetch_assoc()) {
            $subjects[]  = $row[$column1_name];
            $teachers[] = $row[$column2_name];
            }
            
            $combined_data = array_combine($teachers, $subjects);
            shuffle($teachers);
            $subjects = array_intersect_key($combined_data, array_flip($teachers));

            foreach ($teachers as $index => $value) {
                echo "Subject: " .  $subjects[$value] . " Is teached by " .$value . "<br>";
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
?>
</div> 
  
  <table>
        <tr>
            <th>Time Slot</th>
            <th>Monday</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thursday</th>
            <th>Friday</th>
        </tr>



        <?php
        $timeSlots = [            
            "10:30 AM - 11:30 AM",
            "11:30 AM - 12:30 PM",
            "12:30 PM - 1:30 PM",
            "1:30 PM - 1:50 PM",
            "1:50 PM - 2:50 PM",
            "2:50 PM - 3:50 PM",
            "3:50 PM - 4:00 PM", 
        ];


        $morningTimetable = [];

    
        $daysOfWeek = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];

        foreach ($daysOfWeek as $day) {
            $dailyTimetable = [];


            shuffle($subjects);


            for ($i = 0; $i < count($timeSlots); $i++) {
                $timeSlot = $timeSlots[$i];

                if (($timeSlot == "1:30 PM - 1:50 PM") ||($timeSlot == "3:50 PM - 4:00 PM")  ) {
                    $dailyTimetable[$timeSlot] = [
                        "Break" => "Short Break",
                    ];
                } else {
                    $subject = $subjects[$i % count($subjects)];

                    $dailyTimetable[$timeSlot] = [
                        "Lecture" => $subject,
                    ];
                }
            }

            $morningTimetable[$day] = $dailyTimetable;
        }

        foreach ($timeSlots as $timeSlot) {
            echo "<tr>";
            echo "<td>$timeSlot</td>";

            foreach ($daysOfWeek as $day) {
                $entry = $morningTimetable[$day][$timeSlot] ?? null;

                echo "<td>";
                if ($entry) {
                    $lecture = $entry["Lecture"] ?? "";
                    $break = $entry["Break"] ?? "";
                    echo $break ? "Break: $break" : "Lecture: $lecture";
                }
                echo "</td>";
            }

            echo "</tr>";
        }
        ?>
   
<?php
            
            $query = "SELECT tutorial_name, tutorial_teacher FROM tutorials";
            $result = $conn->query($query);

            if (!$result) {
                die("Query failed: " . $conn->error);
            }

            $tut = array();
            $tut_teach = array();

        while ($row = $result->fetch_assoc()) {
            $tut[] = $row['tutorial_name'];
            $tut_teach[] = $row['tutorial_teacher'];
}
    
    $classrooms = ["CL1", "CL2", "CL3"];
    $batches = ["Batch 1", "Batch 2", "Batch 3"];

    $weeklyTimetable = [];
    
    echo "<tr>";
    echo "<td rowspan=3>4:00 PM - 6:00 PM
</td>";
   
    for ($x=1;$x<4;$x++) { 
        
        $subjectAssignment = [];
        $teacherAssignment = [];

        for ($i = 0; $i < count($classrooms); $i++) {
            $classroom = $classrooms[$i];
            $tutori_al = $tut[$i];
            $tut_teach_er = $tut_teach[$i];

            $subjectAssignment[$classroom] = $tutori_al;
            $teacherAssignment[$classroom] = $tut_teach_er;
        }

        shuffle($classrooms);      
        shuffle($batches);

       
        foreach ($classrooms as $classroom) {
        
            $tutori_al = $subjectAssignment[$classroom];
            $tut_teach_er = $teacherAssignment[$classroom];
            $batch = $batches[array_search($classroom, $classrooms)];

           echo "<td>$classroom $batch <br>$tut_teach_er $tutori_al </td>";

        }
  
    for($i=4;$i<6;$i++){
        echo "<td >Club Activity</td>";    
      }

       echo "</tr>";
    }
    echo "</table>";
    ?>
     </table>
</body>
</html>

