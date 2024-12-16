<div id="form-auth">
    <form action="?action=new-password&token=<?= (isset($_GET["token"])) ? $_GET["token"] : "" ?>" method="POST" onsubmit="return validateNewPassword()">
        <h1>Mật khẩu mới</h1>
        <label for="password">Mật khẩu</label>
        <input name="password" type="password" id="password" placeholder="Nhập mật khẩu mới">
        <label for="confirmpassword">Xác nhận mật khẩu</label>
        <input name="confirmpassword" type="password" id="confirmpassword" placeholder="Xác nhận mật khẩu mới">
        <div id="error-confirm"></div>
        <button name="submit">Gửi</button>
    </form>
</div>

<!-- Xử lí hiển thị -->
<?= (isset($result) && $result === "Thành công") ? "<script>Swal.fire({icon: 'success',title: 'Success',text: 'New password activated successfully',}).then((result) => { if (result.isConfirmed) {window.location.href = '?auth=login';}});</script>" : ""?>
<?= (isset($result) && $result === "Lỗi") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Error!',});</script>" : "" ?>
<?= (isset($result) && $result === "Chưa nhập đủ thông tin") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Not enough information has been entered!',});</script>" : "" ?>
<?= (isset($result) && $result === "Mật khẩu không khớp") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Password incorrect!',});</script>" : "" ?>
<!-- Xử lí hiển thị -->