<?php 
if(isset($result)){
    ?>
    <div id="banners">
        <?php 
        foreach ($result as $banner) :
            ?>
            <a href="<?= $banner['url'] ?>">
                <img src="./assets/image/<?= $banner['image'] ?>" alt="">
            </a>
            <?php //HTML
        endforeach;
        ?>
    </div>
    <?php //HTML
}
?>