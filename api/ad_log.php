<?php
session_start(); // Start session at top

include("connect.php");

$u = trim($_POST['adm']);
$up = trim($_POST['password']);

$checka = mysqli_query($connect, "SELECT * FROM new_admin_tb WHERE ad_user='$u' AND ad_pass='$up'");

if(mysqli_num_rows($checka) > 0)
{
    $userdataa = mysqli_fetch_assoc($checka);

    // Save user PRN to session
    $_SESSION['ad_user'] = $userdataa['ad_user'];

    echo '
    <script>
    alert("Login successful!");
    window.location ="../selction.html";
    </script>
    ';
}
else
{
    echo '
    <script>
    alert("Invalid PRN or Password!");
    window.location ="../admin.html";
    </script>
    ';
}
?>