<?php if (isset($_SESSION['identity'])) : ?>
    <h1>Hacer Pedido</h1>
    <a href="<?= base_url ?>carrito/index">Ver Carrito</a>
    <h3>Dirección de envio:</h3>
    <form action="<?= base_url ?>pedido/save" method="post">
        <label for="estado">Estado</label>
        <input type="text" name="estado" id="estado" required>
        <label for="delegacion">Delegación</label>
        <input type="text" name="delegacion" id="delegacion" required>
        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" id="direccion" required>
        <input type="submit" value="Confirmar Pedido">
    </form>
<?php else : ?>
    <h1>No estas identificado</h1>
    <p>Logueate o registrate para poder comprar productos</p>
<?php endif; ?>