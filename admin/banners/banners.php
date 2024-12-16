<table>
    <!-- XỬ LÍ HIỂN THỊ -->
    <?php 
    if(isset($banners)){
        ?>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>URL</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php 
            if(isset($banners)){
                foreach ($banners as $banner){
                    ?>
                    <tr>
                        <td><?= $banner['id'] ?></td>
                        <td><img width="100px" src="../assets/image/<?= $banner['image'] ?>" alt=""></td>
                        <td><?= $banner['url'] ?></td>
                        <td><?= $banner['description'] ?></td>
                        <td><?= $banner['status'] ?></td>
                        <td class="actions">
                            <a href="?room=banners&action=update-banner&status=display&id=<?= $banner['id'] ?>" class="black"><i class="fa-regular fa-eye"></i> Display</a>
                            <a href="?room=banners&action=update-banner&status=hidden&id=<?= $banner['id'] ?>" class="black"><i class="fa-regular fa-eye-slash"></i> Hidden</a>
                            <a href="?room=edit-banner&id=<?= $banner['id'] ?>" class="green"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                            <a onclick="return confirmDelete('?action=delete-banner&id=<?= $banner['id'] ?>&room=banners')" href="" class="red"><i class="fa-solid fa-trash-can"></i> Delete</a>
                        </td>
                    </tr>
                    <?php // HTML
                }
            }
        }else{
            if(!isset($alertDelete) && !isset($alertUpdate)){
                messRed("Empty");
            }
        }
    ?>
    <!-- XỬ LÍ HIỂN THỊ -->
</table>
<!-- Xử lí hiển thị -->
<?= (isset($alertUpdate) && $alertUpdate === "Thành công") ? "<script>Swal.fire({icon: 'success',title: 'Success',text: 'Updated successfully'}).then((result) => { if (result.isConfirmed) {window.location.href = '?room=banners';}});</script>" : ""?>
<?= (isset($alertUpdate) && $alertUpdate === "Lỗi") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Error!',});</script>" : "" ?>
<?= (isset($alertDelete) && $alertDelete === "Thành công") ? "<script>Swal.fire({icon: 'success',title: 'Success',text: 'Deleted successfully',allowOutsideClick: false}).then((result) => { if (result.isConfirmed) {window.location.href = '?room=banners';}});</script>" : ""?>
<?= (isset($alertDelete) && $alertDelete === "Lỗi") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Error!',});</script>" : "" ?>
<!-- Xử lí hiển thị -->