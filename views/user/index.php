<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/style.css">
    <title>User</title>
</head>
<body>
    <?php 
        session_start();
        $user = $_SESSION['user'];
        if (!empty($user)) {
            print_r($user);
        }
    ?>
    <div>Welcome</div>
</body>
</html>