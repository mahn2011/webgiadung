<div id="form-auth">
    <form action="?action=login" method="POST" onsubmit="return validateLogin()">
        <h1>Đăng nhập</h1>
        <label for="email">Email</label>
        <input name="email" type="email" id="email" placeholder="Nhập Email">
        <label for="password">Mật khẩu</label>
        <input name="password" type="password" id="password" placeholder="Nhập Mật khẩu">
        <button name="login">Tiếp tục</button>
        <div class="more-form">
            <span>Chưa có tài khoản?</span>
            <a href="?auth=register">Đăng ký</a>
        </div>
        <div class="more-form">
            <a href="?auth=forgot-password" class="forgotpassword">Quên mật khẩu?</a>
        </div>
        <div class="more-form">
            <a href="../" class="forgotpassword" style="color: red; text-decoration:underline;">Quay lại cửa hàng</a>
        </div>
    </form>
</div>

<!-- Xử lí hiển thị -->
<?= (isset($result) && $result === "Tài khoản của bạn chưa được kích hoạt") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Your account has not been activated!',});</script>" : "" ?>
<?= (isset($result) && $result === "Tài khoản của bạn đã bị vô hiệu hóa") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Your account has been disabled!',});</script>" : ""?>
<?= (isset($result) && $result === "Tài khoản chưa được đăng ký") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Account is not registered!',});</script>" : ""?>
<?= (isset($result) && $result === "Tài khoản của bạn bị lỗi") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Your account is in error!',});</script>" : "" ?>
<?= (isset($result) && $result === "Mật khẩu sai") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Wrong password!',});</script>" : "" ?>
<?= (isset($result) && $result === "Lỗi") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Error!',});</script>" : "" ?>
<!-- Xử lí hiển thị -->