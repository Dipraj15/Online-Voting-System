<?php
header("Content-Type: application/json");

$connect = mysqli_connect("localhost", "root", "", "my_db");
if (!$connect) {
    echo json_encode(["error" => "DB connection failed"]);
    exit;
}

// TOTAL VOTERS
$q1 = mysqli_query($connect, "SELECT COUNT(*) AS total FROM new_sign_tb");
$totalVoters = mysqli_fetch_assoc($q1)['total'];

// TOTAL VOTED
$q2 = mysqli_query($connect, "SELECT COUNT(*) AS voted FROM new_sign_tb WHERE voter = 1");
$totalVoted = mysqli_fetch_assoc($q2)['voted'];

// CANDIDATES
$q3 = mysqli_query($connect, "SELECT cname, symbol, votes FROM new_candidate_db ORDER BY votes DESC");
$candidates = [];
while ($row = mysqli_fetch_assoc($q3)) {
    $candidates[] = $row;
}

echo json_encode([
    "success" => true,
    "total_voters" => $totalVoters,
    "total_voted" => $totalVoted,
    "candidates" => $candidates
]);

mysqli_close($connect);
?>
