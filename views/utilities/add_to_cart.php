<button
    data-title = '<?= $row["name"]?>'
    data-photo = '<?= $row["photo"]?>'
    data-price = '<?= $row["prix"]?>'
    class="add-to-cart">
    <?= $cartText?>
</button>

<script src="../../scripts/add_to_cart.js" defer></script>