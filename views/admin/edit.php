<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Sửa</title>
</head>
<body>
    <div class="center">
            <h1 class="logo">Sửa</h1>
            <form action="?controller=admin&action=update&id=<?php echo $user->id; ?>" method="post">
                <label class="lab">Username</label>
                <input class="inp" type="text" name="username" readonly value="<?php echo $user->username; ?>">

                <label class="lab">New password</label>
                <input class="inp" type="password" name="password" value="" minlength="6" maxlength="255">

                <label class="lab" for="">Confirm password</label>
                <input class="inp" type="password" name="confirm_password" value="" minlength="6" maxlength="255">

                <label class="lab">Họ tên</label>
                <input class="inp" type="text" name="hoten" value="<?php echo $user->hoten; ?>" minlength="6" maxlength="255">

                <label class="lab">Ngày sinh</label>
                <input class="inp" type="date" name="ngaysinh" value="<?php echo $user->ngaysinh; ?>" required>

                <label class="lab">Giới tính</label>
                <select class="inp" name="gioitinh">
                    <option value="1" <?php echo $user->gioitinh == 1 ? 'selected' : '' ?> >Nam</option>
                    <option value="0" <?php echo $user->gioitinh == 0 ? 'selected' : '' ?>>Nữ</option>
                </select>

                <label class="lab">Vai trò</label>
                <select class="inp" name="vaitro" require>
                    <option value="2" <?php echo $user->vaitro_id == 2 ? 'selected' : '' ?>>MEMBER</option>
                    <option value="1" <?php echo $user->vaitro_id == 1 ? 'selected' : '' ?> >ADMIN</option>
                </select>

                <button class="btn-sal" type="submit">Sửa</button>
            </form>
       
    </div>
</body>
</html>
