<?php
// Establish a database connection (replace with your credentials)
$mysqli = new mysqli('localhost', 'root', '', 'disaster_ready');

// Check for connection errors
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Retrieve event details from the form
$event_date = $_POST['eventDate'];
$event_time = $_POST['eventTime'];
$event_name = $_POST['eventTitle'];
$event_description = $_POST['eventDescription'];

// Insert event data into the "events" table
$query = "INSERT INTO events (event_date, event_time, event_name, event_description) VALUES (?, ?, ?, ?)";
$stmt = $mysqli->prepare($query);

if ($stmt === false) {
    die('Error preparing statement.');
}

$stmt->bind_param('ssss', $event_date, $event_time, $event_name, $event_description);

if ($stmt->execute()) {
    $eventAddedSuccessfully = true;
} else {
    $eventAddedSuccessfully = false;
    echo 'Error adding event: ' . $stmt->error;
}

// Close the database connection
$stmt->close();
$mysqli->close();
?>

<script>
    // Display popup message based on the event addition status
    var eventAddedSuccessfully = '<?php echo $eventAddedSuccessfully; ?>';
    if (eventAddedSuccessfully) {
        if (confirm('Event added successfully! Click OK to go to admin-home.php.')) {
            window.location.href = 'admin-home.php';
        }
    } else {
        if (confirm('Error adding event. Please try again. Click OK to go to admin-home.php.')) {
            window.location.href = 'admin-home.php';
        }
    }
</script>
