<form class="input" action="?action=add-product" method="POST" enctype="multipart/form-data" onsubmit="return validateAddProduct()">
    <h1>Add Product</h1>
    <label for="categoryId">Category</label>
    <select name="categoryId" id="categoryId">
        <?php 
        if(isset($categories)){
            foreach ($categories as $category) :
            ?><option value="<?= $category['id'] ?>"><?= $category['categoryName'] ?></option><?php //HTML
            endforeach;
        }
        ?>
    </select>
    <label for="image">Image</label>
    <input type="file" name="image" id="image">
    <label for="">Product Name</label>
    <input type="text" name="productName" id="productName" placeholder="Enter Product Name">
    <label for="">Price</label>
    <input type="number" name="price" id="price" placeholder="Enter Price">
    <label for="">Discount (%)</label>
    <input type="number" name="discount" id="discount" placeholder="%">
    <label for="">Quantity</label>
    <input type="number" name="quantity" id="quantity" placeholder="Enter Quantity">
    <label for="">Description</label>
    <textarea name="description" id="description" cols="30" rows="10" placeholder="Enter Description"></textarea>
    <label for="">Details</label>
    <textarea name="details" id="details" cols="30" rows="10" placeholder="Enter Details"></textarea>
    <button name="add-product">Add Product</button>
</form>
<!-- Xử lí hiển thị -->
<?= (isset($result) && $result === "Thành công") ? "<script>Swal.fire({icon: 'success',title: 'Success',text: 'Added product success',}).then((result) => { if (result.isConfirmed) {window.location.href = '?room=products';}});</script>" : ""?>
<?= (isset($result) && $result === "Chưa nhập đầy đủ thông tin") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Not fully entered information!',});</script>" : "" ?>
<?= (isset($result) && $result === "Lỗi") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Error!',});</script>" : "" ?>
<!-- Xử lí hiển thị -->
