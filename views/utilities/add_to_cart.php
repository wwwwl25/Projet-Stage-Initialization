<?php
$exists = false;
if(isset($_SESSION["cart"])){
    foreach($_SESSION["cart"] as $item){
        if($item['category'] == $t &&  $item['product_id'] == $row["id"] && !str_contains($_SERVER['REQUEST_URI'], 'details.php')){
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
    data-product-id = '<?= $row["id"] . "_". $t?>'
    class="add-to-cart <?php echo $exists ? 'added_to_cart' : ''?>">
    <?php if($exists):?>
        <i class="fa-solid fa-square-check"></i>
    <?php else:?>
        <?= $cartText?>
    <?php endif;?>
</button>

