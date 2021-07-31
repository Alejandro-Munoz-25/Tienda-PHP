<?php if (isset($produ)) : ?>
    <h1><?= $produ->nombre ?></h1>
    <div class="detail-product">
        <div class="image">

            <?php if ($produ->imagen != null || !empty($produ->imagen)) : ?>
                <img src="<?= base_url ?>uploads/images/<?= $produ->imagen ?>" alt="<?= $produ->nombre ?>">
            <?php else : ?>
                <img src="<?= base_url ?>assets/images/camiseta.png" alt="<?= $produ->nombre ?>">
            <?php endif; ?>
        </div>
        <div class="data">
            <p id="description">
                <?= $produ->descripcion ?>
            </p>
            <p id="price">
                $ <?= $produ->precio ?>
            </p>
            <p id="stock">
                Stock: <?= $produ->stock ?>
            </p>
            <a href="<?= base_url ?>carrito/add&id=<?= $produ->id ?>" class="button">Comprar</a>
        </div>
    </div>
<?php else : ?>
    <h1>El producto no existe</h1>
<?php endif; ?>