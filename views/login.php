<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Login</title>
</head>
<body>
    <div class="center">
        <h1 class="logo">Login</h1>
        <form action="?action=login" method="post">
            <?php
            echo '<ul>';
            foreach ($errors as $error) {
                echo '<li class="text-danger">' . $error . '</li>';
            }
            echo '</ul>';
            ?>
            <label class="lab">Username</label>
            <input class="inp" type="text" name="username" required placeholder="Enter username" 
            required minlength="6" maxlength="255">

            <label class="lab">Password</label>
            <input class="inp" type="password" name="password" required placeholder="Enter password" 
            required minlength="6" maxlength="255">

            <button class="btn-blue" type="submit">Login</button>
            <a class="btn-green" href="?controller=register">Register</a>
            <?php
            if (isset($errorLogin)) {
                echo '<span class="text-danger">' . $errorLogin . '</span>';
            }
            ?>
        </form>
    </div>
</body>
</html>
