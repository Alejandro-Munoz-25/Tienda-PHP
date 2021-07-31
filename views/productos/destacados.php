<h1>Algunos de nuestros productos</h1>
<div id="products">
    <?php while ($produ = $productos->fetch_object()) : ?>
        <?php if ($produ->stock > 0) : ?>
            <div class="product">
                <a href="<?= base_url ?>producto/show&id=<?= $produ->id ?>">
                    <?php if ($produ->imagen != null || !empty($produ->imagen)) : ?>
                        <img src="<?= base_url ?>uploads/images/<?= $produ->imagen ?>" alt="<?= $produ->nombre ?>">
                    <?php else : ?>
                        <img src="<?= base_url ?>assets/images/camiseta.png" alt="<?= $produ->nombre ?>">
                    <?php endif; ?>
                    <h2><?= $produ->nombre ?></h2>
                </a>
                <p>
                    <?= $produ->precio ?>
                </p>
                <a href="<?= base_url ?>carrito/add&id=<?= $produ->id ?>" class="button">Comprar</a>
            </div>
        <?php endif; ?>
    <?php endwhile; ?>
</div>