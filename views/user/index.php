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
    <a class="btn-logout" href="?action=logout">Logout</a>
    <div class="center">
        <h1 class="logo">Welcome</h1>
        <form action="#" method="get">
            <label class="lab">Username</label>
            <input class="inp" type="text" value="<?php echo $user->username; ?>" readonly>

            <label class="lab">Họ tên</label>
            <input class="inp" type="text" value="<?php echo $user->hoten; ?>" readonly>

            <label class="lab">Ngày sinh</label>
            <input class="inp" type="date" value="<?php echo $user->ngaysinh; ?>" readonly>

            <label class="lab">Giới tính</label>
            <input class="inp" type="text" value="<?php echo $user->gioitinh === '1' ? 'Nam' : 'Nữ'; ?>" readonly>

            <label class="lab">Vai trò</label>
            <input class="inp" type="text" value="<?php echo $user->vaitro_id === '1' ? 'ADMIN' : 'MEMBER'; ?>" readonly>
        </form>

    </div>
</body>
</html>
