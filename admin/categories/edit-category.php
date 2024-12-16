<form class="input" action="?action=edit-category&id=<?= isset($_GET["id"]) ? $_GET["id"] : "" ?>" method="POST">
    <h1>Edit Category</h1>
    <label for="">New Category Name</label>
    <input type="text" name="categoryName" id="categoryName" placeholder="Enter Category Name" value="<?= $dataOld['categoryName'] ?>">
    <label for="">New Description</label>
    <textarea name="description" id="description" cols="30" rows="10" placeholder="Enter Description"><?= $dataOld['description'] ?></textarea>
    <button name="edit-category">Submit</button>
</form>
<!-- Xử lí hiển thị -->
<?= (isset($result) && $result === "Thành công") ? "<script>Swal.fire({icon: 'success',title: 'Success',text: 'Edited category successfully',}).then((result) => { if (result.isConfirmed) {window.location.href = '?room=categories';}});</script>" : ""?>
<?= (isset($result) && $result === "Chưa nhập đầy đủ thông tin") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Not fully entered information!',});</script>" : "" ?>
<?= (isset($result) && $result === "Lỗi") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Error!',});</script>" : "" ?>
<!-- Xử lí hiển thị -->