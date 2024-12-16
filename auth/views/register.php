<div id="form-auth">
    <form action="?action=register" method="POST" onsubmit="return validateRegister();">
        <h1>Đăng Ký</h1>
        <label for="username">Tên người dùng</label>
        <input name="username" type="text" id="username" placeholder="Nhập tên người dùng">
        <label for="email">Email</label>
        <input name="email" type="email" id="email" placeholder="Nhập email">
        <label for="password">Mật khẩu</label>
        <input name="password" type="password" id="password" placeholder="Nhập mật khẩu">
        <label for="confirmpassword">Xác nhận mật khẩu</label>
        <input name="confirmpassword" type="password" id="confirmpassword" placeholder="Xác nhận mật khẩu">
        <div id="error-confirm"></div>
        <button name="register">Đăng ký</button>
        <div class="more-form">
            <span>Đã là thành viên?</span>
            <a href="?auth=login">Đăng nhập</a>
        </div>
        <div class="more-form">
            <a href="../" class="forgotpassword" style="color: red; text-decoration:underline;">Quay lại cửa hàng</a>
        </div>
    </form>
</div>

<!-- Xử lí hiển thị -->
<?= (isset($result) && $result === "Thành công") ? "<script>Swal.fire({icon: 'success',title: 'Success',text: 'Check your mailbox to activate your account',});</script>" : ""?>
<?= (isset($result) && $result === "Tài khoản đã được đăng ký") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Account has been registered!',});</script>" : "" ?>
<?= (isset($result) && $result === "Kích hoạt tài khoản thành công") ? "<script>Swal.fire({icon: 'success',title: 'Success',text: 'Account activation successful',}).then((result) => { if (result.isConfirmed) {window.location.href = '?auth=login';}});</script>" : "" ?>
<?= (isset($result) && $result === "Lỗi") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Error!',});</script>" : "" ?>
<!-- Xử lí hiển thị -->