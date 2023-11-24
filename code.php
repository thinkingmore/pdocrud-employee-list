<?php
session_start();
include('db.php');

if(isset($_POST['save_record']))
{
    $fullname = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $contact = $_POST['contact'];

    $query = "INSERT INTO employees (name, email, department, contact) VALUES (:fullname, :email, :department, :contact)";
    $query_run = $conn->prepare($query);

    $data = [
        ':fullname' => $fullname,
        ':email' => $email,
        ':department' => $department,
        ':contact' => $contact,
    ];
    $query_execute = $query_run->execute($data);

    if($query_execute)
    {
        $_SESSION['message'] = "Inserted Successfully";
        header('Location: add.php');
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Not Inserted";
        header('Location: add.php');
        exit(0);
    }
}
?>
