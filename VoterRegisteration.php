<?php
$conn = mysqli_connect('localhost', 'root', '', 'voterdatabase');

// Collect form data
$name = $_POST['name'];
$dob = $_POST['dob'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$gender = $_POST['gender'];
$image = $_FILES['photo']['tmp_name']; // Image file
$idtype = $_POST['idtype'];
$cnic = $_POST['cnic'];
$issue = $_POST['issue'];
$expire = $_POST['expire'];
$pass = $_POST['pass'];
$cpass = $_POST['cpass'];

// Check if password and confirm password match
if ($pass == $cpass) {
    // Check if the file was uploaded correctly
    if (is_uploaded_file($image)) {
        // Read image content as binary
        $imageData = file_get_contents($image); // Get image content as binary data

        // Prepare the SQL query for insertion
        $query = "INSERT INTO voterregistration(name, dob, email, mobile, gender, photo, idtype, cnic, issue, expires, pass, cpass, status, votes) 
                  VALUES ('$name', '$dob', '$email', '$mobile', '$gender', ?, '$idtype', '$cnic', '$issue', '$expire', '$pass', '$cpass', 0, 0)";

        // Prepare the statement and bind the parameters
        if ($stmt = mysqli_prepare($conn, $query)) {
            // Bind the BLOB data (image) to the SQL query
            mysqli_stmt_bind_param($stmt, "s", $imageData); // 's' for binary data
            // Execute the query
            if (mysqli_stmt_execute($stmt)) {
                echo '
                <script>
                alert("Form submitted successfully!");
                location="../Voter login Form/index.html";  
                </script>
                ';
            } else {
                echo '
                <script>
                alert("Database insertion failed! Please try again.");
                </script>
                ';
            }
            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo '
            <script>
            alert("Failed to prepare the SQL query.");
            </script>
            ';
        }
    } else {
        echo '<script>alert("Error uploading the image!");</script>';
    }
} else {
    echo '
    <script>
    alert("Password and Confirm password do not match!");
    </script>
    ';
}

// Close the connection
mysqli_close($conn);
?>
