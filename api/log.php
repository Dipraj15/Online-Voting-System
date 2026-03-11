<?php
session_start();
include("connect.php");

$prnn  = trim($_POST['pr']);
$passs = trim($_POST['password']);

$query = "SELECT prn_no, voter FROM new_sign_tb 
          WHERE prn_no='$prnn' AND pass='$passs'";

$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) > 0) {

    $userdata = mysqli_fetch_assoc($result);

    // ❌ If already voted
    if ($userdata['voter'] == 1) {
        echo "
        <script>
            alert('You have already voted!');
            window.location = '../home.html';
        </script>";
        exit;
    }

    // ✅ If not voted
    $_SESSION['prn_no'] = $userdata['prn_no'];

    echo "
    <script>
        alert('Login successful!');
        window.location = '../main.html';
    </script>";
} 
else {
    echo "
    <script>
        alert('Invalid PRN or Password!');
        window.location = '../login_page.html';
    </script>";
}
?>
