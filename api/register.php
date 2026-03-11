<?php
include("connect.php");

$prn = $_POST['pr'];
$fnm = $_POST['in_fn'];
$nmn = $_POST['in_mn'];
$lnm = $_POST['in_ln'];
$dept = $_POST['dept'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$dob = $_POST['date'];
$pass = $_POST['pass'];
$cpass = $_POST['cpass'];

if($pass == $cpass)
{
    // No hashing here
    $insert = "INSERT INTO new_sign_tb(prn_no, f_name, m_name, l_name, dept, mail, gender, dob, pass, status, voter)
    VALUES('$prn', '$fnm', '$nmn','$lnm', '$dept', '$email','$gender','$dob','$pass',0,0)";
    
    if(mysqli_query($connect, $insert))
    {
        echo '
        <script>
        alert("Registration successful!");
        window.location ="../login_page.html";
        </script>
        ';
    }
    else
    {
        echo '
        <script>
        alert("Error during registration!");
        </script>
        ';
    }
}
else
{
    echo '
    <script>
    alert("Passwords do not match!");
    </script>
    ';
}
?>
