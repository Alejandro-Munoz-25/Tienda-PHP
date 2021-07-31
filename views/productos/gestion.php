<h1>Gestion de productos</h1>
<?php
if (isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete') : ?>
    <strong class="alert_success">Producto añadido correctamente</strong>

<?php elseif (isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete') : ?>
    <strong class="alert_error">El producto no se ha creado</strong>
<?php endif; ?>
<?php Utils::deleteSession('producto') ?>
<?php
if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete') : ?>
    <strong class="alert_success">Producto Eliminado correctamente</strong>

<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete') : ?>
    <strong class="alert_error">El producto no se ha eliminado</strong>
<?php endif; ?>
<?php Utils::deleteSession('delete') ?>

<a href="<?= base_url ?>producto/crear" class="button button-sm">Crear Producto</a>
<div style="overflow-x:auto;">
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

            <?php while ($product = $productos->fetch_object()) : ?>
                <tr>
                    <td>
                        <?= $product->id ?>
                    </td>
                    <td>
                        <?= $product->nombre ?>
                    </td>
                    <td>
                        <?= $product->precio ?>
                    </td>
                    <td>
                        <?= $product->stock ?>
                    </td>
                    <td>
                        <a href="<?= base_url ?>producto/editar&id=<?= $product->id ?>" class="button button-gestion">Editar</a>
                        <a href="<?= base_url ?>producto/eliminar&id=<?= $product->id ?>" class="button button-red button-gestion">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>