<form class="input" action="?action=add-banner" method="POST" enctype="multipart/form-data" onsubmit="return validateAddBanner()">
    <h1>Add Banner</h1>
    <label for="image">Image</label>
    <input type="file" name="image" id="image">
    <label for="">URL</label>
    <input type="text" name="url" id="url" placeholder="Enter URL">
    <label for="">Description</label>
    <textarea name="description" id="description" cols="30" rows="10"></textarea>
    <button name="add-banner">Add Banner</button>
</form>
<!-- Xử lí hiển thị -->
<?= (isset($result) && $result === "Thành công") ? "<script>Swal.fire({icon: 'success',title: 'Success',text: 'Added banner success',}).then((result) => { if (result.isConfirmed) {window.location.href = '?room=banners';}});</script>" : ""?>
<?= (isset($result) && $result === "Chưa nhập đầy đủ thông tin") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Not fully entered information!',});</script>" : "" ?>
<?= (isset($result) && $result === "Lỗi") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Error!',});</script>" : "" ?>
<!-- Xử lí hiển thị -->
