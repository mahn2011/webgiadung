<?php 
if(isset($dataOldBanner)){
    ?>
    <form class="input" action="?action=edit-banner&id=<?= (isset($_GET["id"])) ? $_GET["id"] : "" ?>" method="POST" enctype="multipart/form-data" onsubmit="return validateAddBanner()">
        <h1>Edit Banner</h1>
        <label for="image">Image</label>
        <input type="file" name="image" id="image">
        <input type="hidden" name="imageOld" value="<?= $dataOldBanner['image'] ?>">
        <label for="">URL</label>
        <input type="text" name="url" id="url" placeholder="Enter URL" value="<?= $dataOldBanner['url'] ?>">
        <label for="">Description</label>
        <textarea name="description" id="description" cols="30" rows="10"><?= $dataOldBanner['description'] ?></textarea>
        <button name="edit-banner">Edit Banner</button>
    </form>
    <?php // HTML
}else{
    messRed("Empty Data");
}
?>
<!-- Xử lí hiển thị -->
<?= (isset($result) && $result === "Thành công") ? "<script>Swal.fire({icon: 'success',title: 'Success',text: 'Edited banner success',}).then((result) => { if (result.isConfirmed) {window.location.href = '?room=banners';}});</script>" : ""?>
<?= (isset($result) && $result === "Chưa nhập đầy đủ thông tin") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Not fully entered information!',});</script>" : "" ?>
<?= (isset($result) && $result === "Lỗi") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Error!',});</script>" : "" ?>
<!-- Xử lí hiển thị -->
