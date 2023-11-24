<?php
session_start();
include('db.php');


// method to add record

if(isset($_POST['add_record']))
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

// method to edit or update the record

if(isset($_POST['update_record']))
{   
    $employee_id = $_POST['employee_id'];
    $fullname = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $contact = $_POST['contact'];

    try {

        $query = "UPDATE  employees SET name=:fullname, email=:email, department=:department, contact=:contact WHERE id=:employee_id LIMIT 1";
        $statement = $conn->prepare($query);

        $data = [
            ':employee_id' => $employee_id,
            ':fullname' => $fullname,
            ':email' => $email,
            ':department' => $department,
            ':contact' => $contact,
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            $_SESSION['message'] = "Updated Successfully";
            header('Location: index.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Updated";
            header('Location: index.php');
            exit(0);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>



