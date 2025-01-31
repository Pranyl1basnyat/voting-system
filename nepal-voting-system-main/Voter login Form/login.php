<?php
$conn = mysqli_connect('localhost', 'root', '', 'voterdatabase'); 
$cnic= $_POST['cnic'];
$mobile=$_POST['mobile'];
$pass=$_POST['pass'];
$check=mysqli_query($conn,"SELECT * FROM  voterregistration WHERE cnic='$cnic'AND mobile='$mobile' AND pass='$pass' " );
if 

?>