<?php

$errors = [];
$data = [];
if (empty($_POST['name'])||!preg_match("/^[\, \.a-zA-Z-]{3,}$/", $_POST['name'])) {//accept only letters, comma, and period
    $errors['name'] = 'Invalid name.';
}

if (empty($_POST['email'])||!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/", $_POST['email'])) {//only accept valid emails
    $errors['email'] = 'Invalid email.';
}

if (empty($_POST['num'])||!preg_match("/^[09]+[0-9]{9}$/", $_POST['num'])) {
    $errors['num'] = 'Invalid mobile number.';
}

if (empty($_POST['bday'])) {
    $errors['bday'] = 'Birthday is required.';
}

if (empty($_POST['age'])) {
    $errors['age'] = 'Input birthday to calculate.';
}

if (empty($_POST['sex'])) {
    $errors['sex'] = 'Sex not selected.';
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    $data['success'] = true;
    $data['message'] = 'Form sent';
}

echo json_encode($data);

if($data['success']){
    $servername = "localhost";
    $username = "username";
    $password = "";
    $dbname = "temp_db";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO temp_db (name, age, email, phonenumber, sex, bday) 
    VALUES (".$_POST['name'].", ".$_POST['age'].", ".$_POST['email'].", ".$_POST['phonenumber'].", ".$_POST['sex'].", ".$_POST['bday'].")";

    if ($conn->query($sql) === TRUE) {
      echo "Record added";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
