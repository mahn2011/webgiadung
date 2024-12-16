<form class="input" action="?action=add-category" method="POST" onsubmit="return validateAddCategory()">
    <h1>Add Category</h1>
    <label for="">Category Name</label>
    <input type="text" name="categoryName" id="categoryName" placeholder="Enter Category Name">
    <label for="">Description</label>
    <textarea name="description" id="description" cols="30" rows="10" placeholder="Enter Description"></textarea>
    <button name="add-category">Add Category</button>
</form>
<!-- Xử lí hiển thị -->
<?= (isset($result) && $result === "Thành công") ? "<script>Swal.fire({icon: 'success',title: 'Success',text: 'Added category successfully',confirmButtonText: 'View',showCancelButton: true,cancelButtonText: 'Continue',}).then((result) => { if (result.isConfirmed) {window.location.href = '?room=categories';}});</script>" : ""?>
<?= (isset($result) && $result === "Chưa nhập đầy đủ thông tin") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Not fully entered information!',});</script>" : "" ?>
<?= (isset($result) && $result === "Lỗi") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Error!',});</script>" : "" ?>
<!-- Xử lí hiển thị -->