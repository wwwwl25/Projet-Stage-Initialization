<?php
    $compare = ["tableName"=>$t,"productID"=>$row["id"]];
$exists = false;
if(isset($_SESSION["cart"])){
    foreach($_SESSION["cart"] as $item){
        if($item == $compare){
            $exists = true;
        }
    }

}
?>
<button
    data-table = '<?= $t?>'
    data-title = '<?= $row["name"]?>'
    data-photo = '<?= $row["photo"]?>'
    data-price = '<?= $row["prix"]?>'
    data-product-id = '<?= $row["id"]?>'
    class="add-to-cart <?php echo $exists ? 'added_to_cart' : ''?>">
    <?php if($exists):?>
        <i class="fa-solid fa-square-check"></i>
    <?php else:?>
        <?= $cartText?>
    <?php endif;?>
</button>

