<?php
$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$reason = $_POST['reason'];
$appointment = $_POST['appointment'];
$hour = $_POST['hour'];
$duration = $_POST['duration'];
$amount = $_POST['amount'];
$help = $_POST['help'];

if (!empty($username) || !empty($email) || !empty($phone) || 
!empty($reason) || !empty($appointment) || !empty($hour) || !empty($duration) || 
!empty($amount) || !empty($help))  {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "bms form"

    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_error()) {
        die('Connect Error('. mysqli_connect_errno(). ')'. mysqli_connect_error());
    } else {
        $SELECT = "SELECT email From BMS Where email = ? Limit 1";
        $INSERT = "INSERT Into BMS (username, email, phone, reason, appointment, hour, duration, amount, help) 
        values(?, ?, ?, ?, ?, ?, ?, ?, ?)";

        //Prepare statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmnt->bind_result($email);
        $stmnt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum==0) {
           $stmnt->close();

           $stmnt = $conn->prepare($INSERT);
           $stmt->bind_param("ssssii", $username, $email, $phone, $reason, $appointment, 
           $hour, $duration, $amount, $help);
           $stmnt->execute();
           echo "New record inserted successfully";
        } else {
            echo "Someone already registered using this email";
        }
        $stmt->close();
        $conn->close();

} else {
    echo "All fields are required";
    die();
}
?>