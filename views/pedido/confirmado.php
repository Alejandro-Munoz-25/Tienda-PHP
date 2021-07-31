<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete') : ?>

    <h1>Tu pedido se ha confirmado</h1>

    <p>Tu pedido ha sido guardado con exito, una vez que realizes el pago a la cuenta xxxxxxxxxx, el pedido sera procesado y enviado</p>

    <?php if (isset($pedido)) : ?>
        <h3>Datos del pedido: </h3>
        <p>
            Número de pedido: <?= $pedido->id ?>
        </p>
        <p>
            Total a pagar: $<?= $pedido->coste ?>
        </p>
        <p>
            Productos:
        </p>
        <table>
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Unidades</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($producto = $productos->fetch_object()) : ?>
                    <tr>
                        <td>
                            <?php if ($producto->imagen != null || !empty($producto->imagen)) : ?>
                                <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" alt="<?= $producto->nombre ?>" class="img_carrito">
                            <?php else : ?>
                                <img src="<?= base_url ?>assets/images/camiseta.png" alt="<?= $producto->nombre ?>" class="img_carrito">
                            <?php endif; ?>
                        </td>
                        <td><a href="<?= base_url ?>producto/show&id=<?= $producto->id ?>"><?= $producto->nombre ?></a></td>
                        <td><?= $producto->precio ?></td>
                        <td><?= $producto->unidades ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>

<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete') : ?>
    <h1>Tu pedido No se ha procesado!! </h1>

<?php endif; ?>