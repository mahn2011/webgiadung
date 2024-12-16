<div id="form-auth">
    <form action="?action=forgot-password" method="POST" onsubmit="return validateForgotPassword()">
        <h1>Quên Mật Khẩu</h1>
        <label for="email">Email</label>
        <input name="email" type="email" id="email" placeholder="Nhập Email">
        <button name="submit">Tiếp tục</button>
        <div class="more-form">
            <span>Đã có tài khoản?</span>
            <a href="?auth=login">Đăng nhập</a>
        </div>
    </form>
</div>

<!-- Xử lí hiển thị -->
<?= (isset($result) && $result === "Thành công") ? "<script>Swal.fire({icon: 'success',title: 'Success',text: 'Check your email to activate new password',});</script>" : ""?>
<?= (isset($result) && $result === "Tài khoản của bạn chưa được kích hoạt") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Your account has not been activated!',});</script>" : "" ?>
<?= (isset($result) && $result === "Tài khoản của bạn đã bị vô hiệu hóa") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Your account has been disabled!',});</script>" : ""?>
<?= (isset($result) && $result === "Tài khoản chưa được đăng ký") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Account is not registered!',});</script>" : ""?>
<?= (isset($result) && $result === "Tài khoản của bạn bị lỗi") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Your account is in error!',});</script>" : "" ?>
<?= (isset($result) && $result === "Mật khẩu sai") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Wrong password!',});</script>" : "" ?>
<?= (isset($result) && $result === "Lỗi") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Error!',});</script>" : "" ?>
<!-- Xử lí hiển thị -->