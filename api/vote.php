<?php
session_start();
include("connect.php");

// Check if user is logged in
if (!isset($_SESSION['prn_no'])) {
    echo '
    <script>
    alert("You must be logged in to vote.");
    window.location = "../login_page.php";
    </script>';
    exit();
}

$prn = $_SESSION['prn_no'];
$cid = $_POST['cid'];

// Check if user already voted
$check = mysqli_query($connect, "SELECT voter FROM new_sign_tb WHERE prn_no='$prn'");
$row = mysqli_fetch_assoc($check);

if ($row['voter'] == 1) {
    echo '
    <script>
    alert("You have already voted!");
    window.location = "../login_page.html";
    </script>';
    exit();
}

// Add vote to candidate
$updateVote = mysqli_query($connect, "UPDATE new_candidate_db SET votes = votes + 1 WHERE cid = '$cid'");

// Mark user as voted
$markVoted = mysqli_query($connect, "UPDATE new_sign_tb SET voter = 1 WHERE prn_no = '$prn'");

if ($updateVote && $markVoted) {
    echo '
    <script>
    alert("Vote submitted successfully!");
    window.location = "../home.html";
    </script>';
} else {
    echo '
    <script>
    alert("Something went wrong while voting.");
    window.location = "../login_page.html";
    </script>';
}
?>
