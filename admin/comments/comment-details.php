<a href="?room=products" class="back"><i class="fa-solid fa-left-long"></i></a>
<table>
    <?php 
    if(isset($comments)){
        ?>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Category Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        <?php // HTML
        foreach ($comments as $comment) :
            ?>
                <tr>
                    <td><?= $comment['userId'] ?></td>
                    <td><?= $comment['productId'] ?></td>
                    <td><?= $comment['content'] ?></td>
                    <td><?= $comment['createdate'] ?></td>
                    <td class="actions">
                        <form action="" method="POST">
                            <button onclick="return confirmDelete('?room=comment-details&productId=<?= $comment['productId'] ?>&action=delete-comment-details&content=<?= $comment['content']?>')" type="submit" name="delete" class="red"><i class="fa-solid fa-trash-can"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            <?php //HTML
        endforeach;
    }else{
        if(!isset($alertDelete)){
            messRed("Empty Comment");
        }
    }
    ?>
</table>
<!-- input giá trị ẩn để khi xóa có thể trở về lại trang trước -->
<input type="hidden" value="<?= $comment['productId'] ?>" id="productIdCMT">
<!-- Xử lí hiển thị -->
<?= (isset($alertDelete) && $alertDelete === "Thành công") ? "<script> let productIdCMT = document.getElementById('productIdCMT').value; Swal.fire({icon: 'success',title: 'Success',text: 'Deleted successfully',allowOutsideClick: false}).then((result) => { if (result.isConfirmed) {window.location.href = '?room=comment-details&productId='+productIdCMT;}});</script>" : ""?>
<?= (isset($alertDelete) && $alertDelete === "Lỗi") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Error!',});</script>" : "" ?>
<!-- Xử lí hiển thị -->