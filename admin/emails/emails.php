<table>
    <?php 
    if(isset($result)){
        ?>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Create Date</th>
                <th>Actions</th>
            </tr>
        <?php // HTML
        foreach ($result as $email) :
            ?>
                <tr>
                    <td><?= $email['userId'] ?></td>
                    <td><?= $email['name'] ?></td>
                    <td><?= $email['email'] ?></td>
                    <td>
                        <a href="?room=email-details&id=<?= $email['id'] ?>" class="black"><i class="fa-solid fa-magnifying-glass"></i> Read</a>
                    </td>
                    <td><?= $email['createdate'] ?></td>
                    <td class="actions">
                        <a href="?room=reply-email&email=<?= $email['email'] ?>" class="green"><i class="fa-solid fa-reply"></i> Reply</a>
                        <a onclick="return confirmDelete('?action=delete-email&id=<?= $email['id'] ?>')" href="" class="red"><i class="fa-solid fa-trash-can"></i> Delete</a>
                    </td>
                </tr>
            <?php //HTML
        endforeach;
    }else{
        if(!isset($alertDelete)){
            messRed("Empty Email");
        }
    }
    ?>
</table>
<!-- Xử lí hiển thị -->
<?= (isset($alertDelete) && $alertDelete === "Thành công") ? "<script>Swal.fire({icon: 'success',title: 'Success',text: 'Deleted successfully',allowOutsideClick: false}).then((result) => { if (result.isConfirmed) {window.location.href = '?room=emails';}});</script>" : ""?>
<?= (isset($alertDelete) && $alertDelete === "Lỗi") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Error!',});</script>" : "" ?>
<!-- Xử lí hiển thị -->