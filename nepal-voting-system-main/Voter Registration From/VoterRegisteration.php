<?php
$conn = mysqli_connect('localhost', 'root', '', 'voterdatabase');
$name = $_POST['name'];
$dob = $_POST['dob'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$gender = $_POST['gender'];
$image = $_POST['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];
$idtype = $_POST['idtype'];
$cnic = $_POST['cnic'];
$issue = $_POST['issue'];
$expire = $_POST['expire'];
$pass = $_POST['pass'];
$cpass = $_POST['cpass'];

if ($pass == $cpass) {
    if (move_uploaded_file($tmp_name, "../VoterImage/$image")) {
        $insert = mysqli_query($conn, "INSERT INTO VOTERREGISTRATION(name, dob, email, gender, photo, idtype, cnic, issue, expire, pass, cpass, status, votes) VALUES ('$name', '$dob', '$email', '$mobile', '$image', '$idtype', '$cnic', '$issue', '$expire', '$pass', '$cpass', 0, 0)");

        echo '
        <script>
        alert("Form submitted successfully!");
        location="../Voter login Form/index.html";  
        </script>
        ';
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
?>
