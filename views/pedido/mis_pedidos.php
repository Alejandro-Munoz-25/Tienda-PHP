<?php if (isset($gestion)) : ?>
    <h1>Gestionar Pedidos</h1>
<?php else : ?>
    <h1>Mis Pedidos</h1>
<?php endif; ?>
<table>
    <thead>
        <tr>
            <th>N° Pedido</th>
            <th>Coste</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Detalles del Pedido</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($pedidoUs = $pedidos->fetch_object()) : ?>
            <tr>
                <td> <?= $pedidoUs->id ?> </td>
                <td> $<?= $pedidoUs->coste ?> </td>
                <td><?= $pedidoUs->fecha ?> </td>
                <td><?= Utils::showStatus($pedidoUs->estado) ?> </td>
                <td><a class="button b-detalle" href="<?= base_url ?>pedido/detalle&id=<?= $pedidoUs->id ?>"> Detalle</a></td>
            </tr>
        <?php endwhile;  ?>
    </tbody>
</table>