<a href="?room=users" class="back"><i class="fa-solid fa-left-long"></i></a>
<table>
    <!-- /* ---------------------------------- DATA ---------------------------------- */ -->
    <?php 
    if(isset($result)){
        ?>
        <tr>
            <th>User ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Number Phone</th>
        </tr>
        <?php // HTML
        foreach ($result as $users => $user) :
        ?>
        <tr>
            <td><?= $user['userId'] ?></td>
            <td><?= $user['fullName'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['address'] ?></td>
            <td><?= $user['numberphone'] ?></td>
        </tr>
        <?php // HTML
        endforeach;
    }else{
        messRed("Empty");
    }
    ?>
    <!-- /* ---------------------------------- DATA ---------------------------------- */ -->
</table>