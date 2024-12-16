<table>
    <?php 
    if(isset($result)){
        ?>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Category Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        <?php // HTML
        foreach ($result as $categories => $category) :
            ?>
                <tr>
                    <td><?= $category['id'] ?></td>
                    <td><?= $category['userId'] ?></td>
                    <td><?= $category['categoryName'] ?></td>
                    <td><?= $category['description'] ?></td>
                    <td class="actions">
                        <form action="?action=delete-category" method="POST">
                            <a class="green" href="?room=edit-category&id=<?= $category['id']?>"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                            <button onclick="return confirmDelete('?action=delete-category&id=<?= $category['id']?>')" type="submit" name="delete" class="red"><i class="fa-solid fa-trash-can"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            <?php //HTML
        endforeach;
    }else{
        if(!isset($alertDelete)){
            messRed("Empty Category");
        }
    }
    ?>
</table>
<!-- Xử lí hiển thị -->
<?= (isset($alertDelete) && $alertDelete === "Thành công") ? "<script>Swal.fire({icon: 'success',title: 'Success',text: 'Deleted successfully',allowOutsideClick: false}).then((result) => { if (result.isConfirmed) {window.location.href = '?room=categories';}});</script>" : ""?>
<?= (isset($alertDelete) && $alertDelete === "Lỗi") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Error!',});</script>" : "" ?>
<!-- Xử lí hiển thị -->