<h1>Carrito de Compras</h1>
<?php if ($carrito) : ?>
    <?php if (isset($_SESSION['stock'])) : ?>
        <p class="alert_error">No hay mas stock para <?= $_SESSION['stock'] ?></p>
    <?php endif; ?>
    <?php
    Utils::deleteSession('stock');
    ?>
    <div class="table">
        <table>
            <thead>

                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Unidades</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($carrito as $indice => $elemento) :
                    $producto = $elemento['producto'];  ?>
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
                        <td>
                            <div class="updown-unidades">
                                <a href="<?= base_url ?>carrito/decrement&id=<?= $indice ?>" class="button button-red b-decrement">–</a>
                                <span> <?= $elemento['unidades'] ?></span>
                                <a href="<?= base_url ?>carrito/increment&id=<?= $indice ?>" class="button b-incre">+</a>
                            </div>
                        </td>
                        <td> <a href="<?= base_url ?>carrito/remove&id=<?= $indice ?>" class=" button button-red b-eliminar-carrito">X</a></td>
                    </tr>
                <?php endforeach;  ?>
            </tbody>
        </table>


    </div>
    <div class="info">
        <div class="eliminar-carrito">
            <a href="<?= base_url ?>carrito/deleteAll" class="button button-pedido button-red">Eiminar Todo el Carrito</a>
        </div>
        <div class="total-carrito">
            <?php $stats = Utils::statsCarrito(); ?>
            <h3>Precio Total: $<?= $stats['total'] ?></h3>
            <a href="<?= base_url ?>pedido/add" class="button button-pedido">Hacer Pedido</a>
        </div>
    </div>
<?php else : ?>
    <h3>No hay Productos en el carrito</h3>
<?php endif; ?>