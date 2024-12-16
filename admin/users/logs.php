<a href="?room=users" class="back"><i class="fa-solid fa-left-long"></i></a>
<table>
    <!-- /* ----------------------------- XỬ LÍ HIỂN THỊ ----------------------------- */ -->
    <?php 
    if(is_object($result)){
        ?>
        <tr>
            <th>User ID</th>
            <th>Login Time</th>
            <th>Logout Time</th>
        </tr>
        <?php // HTML
        foreach ($result as $logs => $log):
            ?>
            <tr>
                <td><?= $log['userId'] ?></td>
                <td><?= $log['loginTime'] ?></td>
                <td><?= $log['logoutTime'] ?></td>
            </tr>
            <?php // HTML
        endforeach;
    }else{
        messRed("No Data");
    }
    ?>
    <!-- /* ----------------------------- XỬ LÍ HIỂN THỊ ----------------------------- */ -->
</table>