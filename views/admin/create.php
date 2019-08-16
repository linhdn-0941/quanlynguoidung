<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Thêm mới</title>
</head>
<body>
    <div class="center">
        <h1 class="logo">Thêm mới</h1>
        <form action="#" method="post">
                <label class="lab">Username</label>
                <input class="inp" type="text" name="username" placeholder="Enter username" required>

                <label class="lab">Password</label>
                <input class="inp" type="password" name="password" placeholder="Enter password" required>

                <label class="lab">Confirm password</label>
                <input class="inp" type="password" name="confirm_password" placeholder="Confirm password" required>

                <label class="lab">Họ tên</label>
                <input class="inp" type="text" name="hoten" placeholder="Enter" required>

                <label class="lab">Ngày sinh</label>
                <input class="inp" type="date" name="ngaysinh" required>

                <label class="lab">Giới tính</label>

                <select class="inp" name="gioitinh">
                    <option value="1">Nam</option>
                    <option value="0">Nữ</option>
                </select>

                <label class="lab">Vai trò</label>
                <select class="inp" name="vaitro" require>
                    <option value="2">MEMBER</option>
                    <option value="1">ADMIN</option>
                </select>

                <button class="btn-blue" type="submit">Thêm</button>
                <button class="btn-sal" type="reset">Reset</button>
        </form>
    </div>
</body>
</html>