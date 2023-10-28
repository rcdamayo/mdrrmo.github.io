<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disaster Ready: Flood Advisories</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/admin-population.css">
    <link rel="icon" href="images/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="topnav" id="myTopnav">
  <img src="images/icon.png">
    <div class="topcont">
      <div class="p1">Republic of the Philippines</div>
      <div class="p2">Municipality of Barugo</div>
      <div class="p3">MDRRMO</div>
    </div>
    
    <div class="dropdown">
    <?php
    // Assuming you have stored the logged-in user's ID in a session variable named $_SESSION['id']
    if(isset($_SESSION['id'])){
        $logged_in_id = $_SESSION['id'];

        // Connect to your MySQL database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "disaster_ready";

        $conn = new mysqli($servername, $username, $password, $database);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT image, employee_id FROM users WHERE id = $logged_in_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                $image = $row["image"];
                $employee_id = $row["employee_id"];
                echo "<div class='dropdown'>
                        <button class='dropbtn'><img src='$image' alt='User Image'>$employee_id
                            <i class='fa fa-caret-down' style='margin-left: 1em;'></i>
                        </button>
                        <div class='dropdown-content'>
                            <a href='logout.php' style='width: 14em; padding: 0; border-top: 1px solid #e5a920; font-size: 12px; padding-left: 0;'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 256 256'><path d='M112,216a8,8,0,0,1-8,8H48a16,16,0,0,1-16-16V48A16,16,0,0,1,48,32h56a8,8,0,0,1,0,16H48V208h56A8,8,0,0,1,112,216Zm109.66-93.66-40-40A8,8,0,0,0,168,88v32H104a8,8,0,0,0,0,16h64v32a8,8,0,0,0,13.66,5.66l40-40A8,8,0,0,0,221.66,122.34Z'></path></svg>
                                <p>Logout</p>
                            </a>
                        </div>
                    </div>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
    } else {
        // Handle the case where the user is not logged in
        // You might want to redirect the user to the login page or handle the situation in some other way
        echo "User not logged in.";
    }
?>


<script>
  // JavaScript for dropdown functionality
  document.addEventListener("DOMContentLoaded", function() {
    var dropdown = document.querySelector(".dropdown");
    dropdown.addEventListener("click", function() {
      var dropdownContent = dropdown.querySelector(".dropdown-content");
      dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
    });
  });
</script>
</div>

    <a href="reports-flood.php">
      <div class="navcont">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256">
          <path d="M88,112a8,8,0,0,1,8-8h80a8,8,0,0,1,0,16H96A8,8,0,0,1,88,112Zm8,40h80a8,8,0,0,0,0-16H96a8,8,0,0,0,0,16ZM232,64V184a24,24,0,0,1-24,24H32A24,24,0,0,1,8,184.11V88a8,8,0,0,1,16,0v96a8,8,0,0,0,16,0V64A16,16,0,0,1,56,48H216A16,16,0,0,1,232,64Zm-16,0H56V184a23.84,23.84,0,0,1-1.37,8H208a8,8,0,0,0,8-8Z"></path>
        </svg>
        <br>Reports
      </div>
    </a>

    <a href="admin-map.php">
      <div class="navcont">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256">
          <path d="M228.92,49.69a8,8,0,0,0-6.86-1.45L160.93,63.52,99.58,32.84a8,8,0,0,0-5.52-.6l-64,16A8,8,0,0,0,24,56V200a8,8,0,0,0,9.94,7.76l61.13-15.28,61.35,30.68A8.15,8.15,0,0,0,160,224a8,8,0,0,0,1.94-.24l64-16A8,8,0,0,0,232,200V56A8,8,0,0,0,228.92,49.69ZM104,52.94l48,24V203.06l-48-24ZM40,62.25l48-12v127.5l-48,12Zm176,131.5-48,12V78.25l48-12Z"></path>
        </svg>
        <br>Map
      </div>
    </a>

    <a href="admin-population.php" class="active">
      <div class="navcont">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256">
          <path d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z"></path>
        </svg>
        <br>Population
      </div>
    </a>

    <a href="admin-about.php">About</a>
    <a href="admin-sms.php">SMS</a>
    <a href="admin-flood.php">Flood</a>
    <a href="admin-home.php">Home</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
      <i class="fa fa-bars"></i>
    </a>
</div>

<div class="main">

<!-- POPULATION DATA -->
  <div class="division">
  <?php
// Connect to your MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$database = "disaster_ready";

$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch hazard-prone area data from the database
$sql = "SELECT * FROM population_data";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<form id='updateForm' onsubmit='submitForm(event)' method='post' action='update_population.php'>";
    echo "<h2 class='population-header'>UPDATE POPULATION DATA</h2>";
    echo "<button class='update-population' type='submit'>UPDATE</button>";
    echo "<div class='population-container'>";
    echo "<table class='population-table'>";
    echo "<tr>
            <th>Barangay</th>
            <th>Population (2015)</th>
            <th>Population (2020)</th>
            <th>Population Change</th>
            <th>Annual Population Growth Rate</th>
        </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['barangay'] . "</td>";
        echo "<td><input type='text' name='population_2015[]' value='" . $row['population_2015'] . "'></td>";
        echo "<td><input type='text' name='population_2020[]' value='" . $row['population_2020'] . "'></td>";
        echo "<td><input type='text' name='population_change[]' value='" . $row['population_change'] . '%' . "'></td>";
        echo "<td><input type='text' name='rate[]' value='" . $row['rate'] . '%' . "'></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</form>";
} else {
    echo "0 results";
}
$conn->close();
?>
  </div>
  </div>


  <!-- AGE GROUP -->
  <div class="division">

<!-- HOUSEHOLD DATA -->
  <form id='editForm' method='post'>
        <button type='button' class='submit-prone' onclick='updateData()'>UPDATE</button>

        <div class="prone-table">

        <?php
    // Connect to your MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "disaster_ready";

    $conn = new mysqli($servername, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch hazard-prone area data from the database
    $sql = "SELECT * FROM household_data";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class='table-data'>
                <tr>
                    <th>Year</th>
                    <th>Household Population</th>
                    <th>No. of Households</th>
                    <th>Average Household Size</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td style='font-weight: 600;'><input type='text' name='year[]' value='" . $row["year"] . "'></td>
                <td><input type='text' name='household_population[]' value='" . $row["household_population"] . "'></td>
                <td><input type='text' name='no_of_households[]' value='" . $row["no_of_households"] . "'></td>
                <td><input type='text' name='average_household_size[]' value='" . $row["average_household_size"] . "'></td>
                <input type='hidden' name='id[]' value='" . $row["id"] . "'>
            </tr>";
        }

        echo "</table>";
        echo '<button type="button" class="add-row" onclick="addRow()">+</button>';
        echo "</form>";
    } else {
        echo "No results found";
    }

    $conn->close();
?>


  </div>

  <?php
// Connect to your MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$database = "disaster_ready";

$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch hazard-prone area data from the database
$sql = "SELECT * FROM age_group";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<form id='updateForm' onsubmit='submitForm(event)' method='post' action='update_ageGroup.php'>";
    echo "<h2 class='ageGroup-header'>UPDATE AGE GROUP DATA</h2>";
    echo "<button class='ageGroup-population' type='submit'>UPDATE</button>";
    echo "<div class='ageGroup-container'>";
    echo "<table class='ageGroup-table'>";
    echo "<tr>
            <th>Age Group</th>
            <th>Population (2015)</th>
            <th>Age Group Percentage</th>
        </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['age_group'] . "</td>";
        echo "<td><input type='text' name='population_2015[]' value='" . $row['population_2015'] . "'></td>";
        echo "<td><input type='text' name='age_percentage[]' value='" . $row['age_percentage'] . '%' . "'></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</form>";
} else {
    echo "0 results";
}
$conn->close();
?>


<div id="snackbar"></div>
<script>

    function updateAge() {
        var form = document.getElementById("editAge");
        var formData = new FormData(form);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update_age.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var response = xhr.responseText.trim();
                    if (response.includes('Error')) {
                        showSnackbar("Error updating records");
                    } else {
                        showSnackbar("Records updated successfully");
                    }
                } else {
                    showSnackbar("Error updating records");
                }
            }
        };
        xhr.send(formData);
    }

    function updateHousehold() {
    var form = document.getElementById("editHousehold");
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_household.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = xhr.responseText.trim();
                if (response.includes('Error')) {
                    showSnackbar("Error updating records");
                } else {
                    showSnackbar("Records updated successfully");
                }
            } else {
                showSnackbar("Error updating records");
            }
        }
    };
    xhr.send(formData);
}

var cells = document.querySelectorAll("td input");
cells.forEach(function(cell) {
    cell.setAttribute("contentEditable", true);
});

function addRow() {
    var tables = document.getElementsByClassName('table-data');
    var table = tables[0]; // Assuming the first table with the class "map-markers-table"

    var newRow = table.insertRow(-1);

    var cell1 = newRow.insertCell(0);
    var cell2 = newRow.insertCell(1);
    var cell3 = newRow.insertCell(2);
    var cell4 = newRow.insertCell(3);

    cell1.innerHTML = "<input type='text' name='year[]' value=''>";
    cell2.innerHTML = "<input type='text' name='new_household_population[]' value=''>";
    cell3.innerHTML = "<input type='text' name='new_no_of_households[]' value=''>";
    cell4.innerHTML = "<input type='text' name='new_average_household_size[]' value=''>";
    
}

function updatePopulation() {
        var form = document.getElementById("editPopulation");
        var formData = new FormData(form);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update_population.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var response = xhr.responseText.trim();
                    if (response.includes('Error')) {
                        showSnackbar("Error updating records");
                    } else {
                        showSnackbar("Records updated successfully");
                    }
                } else {
                    showSnackbar("Error updating records");
                }
            }
        };
        xhr.send(formData);
    }
</script>
  </div>
</div>
</body>
</html>