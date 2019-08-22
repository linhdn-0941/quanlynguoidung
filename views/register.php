<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Register</title>
</head>
<body>
    <div class="center">
        <h1 class="logo">Register</h1>
            <form action="?controller=register&action=store" method="post">
                <?php
                    echo '<ul>';
                    foreach ($errors as $error) {
                        echo '<li class="text-danger">' . $error . '</li>';
                    }
                    echo '</ul>'
                ?>
                <label class="lab">Username</label>
                <input class="inp" type="text" name="username" placeholder="Enter username" required minlength="6" maxlength="255">

                <label class="lab">Password</label>
                <input class="inp" type="password" name="password" placeholder="Enter password" required minlength="6" maxlength="255">

                <label class="lab">Confirm password</label>
                <input class="inp" type="password" name="confirm_password" placeholder="Confirm password" required minlength="6" maxlength="255">

                <label class="lab">Name</label>
                <input class="inp" type="text" name="hoten" placeholder="Enter name" required minlength="6" maxlength="255">

                <label class="lab">Date of birth</label>
                <input class="inp" type="date" name="ngaysinh" required>

                <label class="lab">Gender</label>
                <select class="inp" name="gioitinh" required>
                    <option value="1">Nam</option>
                    <option value="0">Nữ</option>
                </select>

                <button class="btn-blue" type="submit">Register</button>
                <button class="btn-sal" type="reset">Reset</button>
            </form>
        </div>
    </div>
</body>
</html>
