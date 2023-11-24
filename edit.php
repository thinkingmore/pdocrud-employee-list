<?php 
    session_start();
    include('db.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD with PDO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 text-center mt-2">
                <h1>Edit this Record</h1>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="#" class="btn btn-primary">Go Back</a>
                    </div>
                    <div class="card-body">
                    <?php
                        if(isset($_GET['id']))
                        {
                            $employee_id = $_GET['id'];

                            $query = "SELECT * FROM employees WHERE id=:employee_id LIMIT 1";
                            $statement = $conn->prepare($query);
                            $data = [':employee_id' => $employee_id];
                            $statement->execute($data);

                            $result = $statement->fetch(PDO::FETCH_OBJ); //PDO::FETCH_ASSOC
                        }
                        ?>
                        <form action="code.php" method="POST">
                            <input type="hidden" name="employee_id" value="<?=$result->id?>" />
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" value="<?= $result->name; ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" value="<?= $result->email; ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="department" class="form-label">Department</label>
                                <input type="text" name="department" value="<?= $result->department; ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="contact" class="form-label">Contact</label>
                                <input type="text" name="contact" value="<?= $result->contact; ?>" class="form-control">
                            </div>
                            <button type="submit" name="update_record" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>