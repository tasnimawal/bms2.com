<?php
    $username = $_POST['username']; #Here I am specifying the input field name with all the fields.
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $reason = $_POST['reason'];
    $appointment = $_POST['appointment'];
    $hour = $_POST['hour'];
    $duration = $_POST['duration'];
    $amount = $_POST['amount'];
    $help = $_POST['help'];

    //Database connection
    $conn = new mysqli('localhost', 'root', '','bms form');
    if ($conn->connect_error){
        die('Connecton Failed : '.$conn->connect_error); #Here I am stating that if the connection failed, I will get told about this.
    }else{ #If there is no error, then the else loop will execute.
        $stmt = $conn->prepare("insert into registration(username, email,
        phone, reason, appoinment, hour, duration, amount, help)
        values(?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisiisis",$username, $email, $phone, $reason, $appointment, $hour,
        $duration, $amount, $help); #This tells us whether each of the fields is a string or an integer; all the field names are listed.
        $stmt->close(); #Ends the statement.
        $conn->close(); #Ends the connection entirely.
    } 
?>