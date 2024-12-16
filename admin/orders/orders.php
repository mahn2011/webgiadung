<table>
    <?php 
    if(isset($result)){
        ?>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>User ID Handle</th>
            <th>Create Date</th>
            <th>Total</th>
            <th>Process</th>
            <th>Status</th>
            <th>Note</th>
            <th>Action</th>
        </tr>
        <?php // HTML
        foreach ($result as $order) :
        ?>
        <tr>
            <td><?= $order['id'] ?></td>
            <td><?= $order['userId'] ?></td>
            <td>
                <?= ($order['userIdHandle'] === 0) ? "not yet" : $order['userIdHandle'] ?>
            </td>
            <td><?= $order['createdate'] ?></td>
            <td><?= number_format($order['total']) ?> VNĐ</td>
            <td>
                <?php 
                // Xử lí hiển thị - màu
                $process = $order['process'];
                $colorPC = "";
                if($process === "confirm"){
                    $colorPC = "navi";
                }
                if($process === "processing"){
                    $colorPC = "orange";
                }
                if($process === "delivering"){
                    $colorPC = "blue";
                }
                if($process === "completed"){
                    $colorPC = "green";
                }
                // Xử lí hiển thị - màu
                ?>
                <span class="span-<?= $colorPC ?>"><?= $process ?></span>
            </td>
            <td>
                <!-- XỬ LÍ HIỂN THỊ CHO ĐẸP -->
                <?php 
                $status = $order["status"];
                $colorST = "";
                if($status === "paid"){
                    $colorST = "green";
                }elseif($status === "unpaid"){
                    $colorST = "red";
                }elseif($status === "boom"){
                    $colorST = "red";
                }
                ?>
                <!-- XỬ LÍ HIỂN THỊ CHO ĐẸP -->
                <span class="span-<?= $colorST ?>"><?= $status ?></span>
            </td>
            <td><a class="black" href="?room=note-details&id=<?= $order['id'] ?>">Details</a></td>
            <td class="actions">
                <form action="" method="POST">
                    <!-- KIỂM TRA ĐƠN HÀNG ĐÃ CÓ AI CHỊU TRÁCH NHIỆM HAY CHƯA -->
                    <?php 
                    if(!is_null($order['userIdHandle'])){
                        ?>
                        <button onclick="return confirmAction('?room=orders&action=update-order&id=<?= $order['id'] ?>&value=processing')" name="processing" class="black"><i class="fa-solid fa-spinner"></i></button>
                        <button onclick="return confirmAction('?room=orders&action=update-order&id=<?= $order['id'] ?>&value=delivering')" name="delivering" class="black"><i class="fa-solid fa-truck-fast"></i></button>
                        <button onclick="return confirmAction('?room=orders&action=update-order&id=<?= $order['id'] ?>&value=completed')" name="completed" class="black"><i class="fa-solid fa-check"></i></button>
                        <button onclick="return confirmAction('?room=orders&action=update-order&id=<?= $order['id'] ?>&value=paid')" name="paid" class="green"><i class="fa-solid fa-money-check-dollar"></i></button>
                        <button onclick="return confirmAction('?room=orders&action=update-order&id=<?= $order['id'] ?>&value=unpaid')" name="unpaid" class="red"><i class="fa-solid fa-money-check-dollar"></i></button>
                        <button onclick="return confirmAction('?room=orders&action=update-order&id=<?= $order['id'] ?>&value=boom')" name="boom" class="red"><i class="fa-solid fa-bomb"></i></button>
                        <!-- DELETE -->
                        <?php 
                        if($_SESSION["user"]["role"] === "admin"){
                            ?><button onclick="return confirmDelete('?room=orders&action=delete-order&id=<?= $order['id'] ?>')" class="red"><i class="fa-solid fa-trash-can"></i></button><?php
                        }
                        ?>
                        <!-- DELETE -->
                        <?php //HTML
                    }else{
                        ?><button onclick="return confirmAction('?room=orders&action=receive-order&id=<?= $order['id'] ?>')" name="confirm" class="black"><i class="fa-solid fa-hand-back-fist"></i>  Receive</button><?php // HTML
                    }
                    ?>
                    <!-- KIỂM TRA ĐƠN HÀNG ĐÃ CÓ AI CHỊU TRÁCH NHIỆM HAY CHƯA -->
                    <a href="?room=order-details&orderId=<?= $order['id'] ?>" class="green"><i class="fa-regular fa-eye"></i> View</a>
                </form>
            </td>
        </tr>
        <?php // HTML
        endforeach;
    }else{
        if(!isset($alertDelete) && !isset($alertUpdate)){
            messRed("Chưa có đơn hàng nào huhuhu !!!");
        }
    }
    ?>
</table>

<!-- Xử lí hiển thị -->
<?= (isset($alertUpdate) && $alertUpdate === "Cập nhật thành công") ? "<script>Swal.fire({icon: 'success',title: 'Success',text: 'Success',allowOutsideClick: false}).then((result) => { if (result.isConfirmed) {window.location.href = '?room=orders';}});</script>" : ""?>
<?= (isset($alertUpdate) && $alertUpdate === "Lỗi") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Error!',});</script>" : "" ?>
<?= (isset($alertDelete) && $alertDelete === "Thành công") ? "<script>Swal.fire({icon: 'success',title: 'Success',text: 'Deleted successfully',allowOutsideClick: false}).then((result) => { if (result.isConfirmed) {window.location.href = '?room=orders';}});</script>" : ""?>
<?= (isset($alertDelete) && $alertDelete === "Lỗi") ? "<script>Swal.fire({icon: 'error',title: 'Oops...',text: 'Error!',});</script>" : "" ?>
<!-- Xử lí hiển thị -->