<a href="?room=orders" class="back"><i class="fa-solid fa-left-long"></i></a>
<table>
    <?php 
    if(isset($result)){
        ?>
            <tr>
                <th>Note</th>
            </tr>
            <tr>
                <td class="textleft"><?= $result['note'] ?></td>
            </tr>
        <?php // HTML
    }else{
        messRed("Empty note");
    }
    ?>
</table>