<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Quản lý người dùng</title>
</head>
<body>
    <div>
        <h1 class="logo">
            Quản lý người dùng
        </h1>
        <a class="btn-blue" href="?controller=admin&action=create">Thêm mới</a>
        <a class="btn-logout" href="?action=logout">Logout</a>
        <div>
            <table class="users">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Họ tên</th>
                    <th>Ngày sinh</th>
                    <th>Giới tính</th>
                    <th>Vai trò</th>
                    <th>Tác vụ</th>
                </tr>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['hoten']; ?></td>
                        <td><?php echo $user['ngaysinh']; ?></td>
                        <td><?php echo $user['gioitinh'] == 1 ? 'Nam' : 'Nu'?></td>
                        <td><?php echo $user['vaitro']; ?></td>
                        <td>
                            <a class="btn-sal" href="?controller=admin&action=edit&id=<?php echo $user['id']; ?>">Sửa</a>
                            <a class="btn-red" href="#">Xóa</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>
