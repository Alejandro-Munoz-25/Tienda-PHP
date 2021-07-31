<h1>Detalle del pedido </h1>
<?php if (isset($pedido)) : ?>
    <?php if (isset($_SESSION['admin'])) : ?>
        <h3>Cambiar Estado del Pedido</h3>
        <form action="<?= base_url ?>pedido/estado" method="POST">
            <input type="hidden" name="pedido_id" value="<?= $pedido->id ?>">
            <select name="estado" id="estado">
                <option value="confirm" <?= $pedido->estado == "confirm" ? 'selected' : '' ?>>Pendiente</option>
                <option value="preparation" <?= $pedido->estado == "preparation" ? 'selected' : '' ?>>En preparacion</option>
                <option value="ready" <?= $pedido->estado == "ready" ? 'selected' : '' ?>>Preparado para enviar</option>
                <option value="sended" <?= $pedido->estado == "sended" ? 'selected' : '' ?>>Enviado</option>
            </select>
            <input type="submit" value="Actualizar Pedido">
        </form>
        <div class="info-detalles">

            <h3>Datos del Usuario: </h3>
            <p> Id: <?= $pedido->usuarioId ?></p>
            <p> Nombre: <?= $pedido->nombreU ?></p>
            <p> Email: <?= $pedido->email ?></p>
        <?php endif; ?>

        <h3>Dirección de envio: </h3>
        <p>Estado: <?= $pedido->c_estado ?> </p>
        <p>Delegación: <?= $pedido->delegacion ?> </p>
        <p>Calle: <?= $pedido->direccion ?> </p>

        <h3>Datos del pedido: </h3>
        <p> Número de pedido: <?= $pedido->id ?></p>
        <p> Total a pagar: $<?= $pedido->coste ?></p>
        <p> Estado del Pedido: <?= Utils::showStatus($pedido->estado) ?></p>
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
        </div>

    <?php endif; ?>