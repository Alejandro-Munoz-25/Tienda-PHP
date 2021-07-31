<!-- BARRA LATERLA -->
<aside id="lateral">
    <div id="login" class="block-aside">
        <h3>Carrito de Compras</h3>
        <ul>
            <li>
                <?php $stats = Utils::statsCarrito() ?>
                <a href="<?= base_url ?>carrito/index">Productos (<?= $stats['count'] ?>)</a>
            </li>
            <li>
                <a href="<?= base_url ?>carrito/index">Total en el Carrito: $<?= $stats['total'] ?></a>
            </li>
            <li>
                <a href="<?= base_url ?>carrito/index">Ver Carrito</a>
            </li>
        </ul>
    </div>
    <div id="login" class="block-aside">
        <?php if (!isset($_SESSION['identity'])) : ?>
            <h3>Entrar a la Web</h3>
            <?php if (isset($_SESSION['error_login'])) : ?>
                <div class="alert_error"><?= $_SESSION['error_login'] ?></div>
            <?php endif; ?>
            <?php
            Utils::deleteSession('error_login');
            ?>
            <form action="<?= base_url ?>usuario/login" method="post">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password">
                <?php if (!isset($_SESSION['identity']) || !isset($_SESSION['admin'])) : ?>
                    <label><a href="<?= base_url ?>usuario/registro">Registrarse</a></label>
                <?php endif; ?>
                <input type="submit" value="Entrar">
            </form>
        <?php else : ?>
            <h3><?= $_SESSION['identity']->nombre . ' ' . $_SESSION['identity']->apellidos ?></h3>
        <?php endif; ?>
        <ul>
            <?php if (isset($_SESSION['admin'])) : ?>
                <li>
                    <a href="<?= base_url ?>pedido/gestion">Gestionar Pedidos</a>
                </li>
                <li>
                    <a href="<?= base_url ?>producto/gestion">Gestionar Productos</a>
                </li>
                <li>
                    <a href="<?= base_url ?>categoria/index">Gestionar Categorias</a>
                </li>
            <?php endif; ?>

            <?php if (isset($_SESSION['identity'])) : ?>
                <li>
                    <a href="<?= base_url ?>pedido/misPedidos">Mis Pedidos</a>
                </li>
                <li>
                    <a href="<?= base_url ?>usuario/logout">Cerrar Sesión</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</aside>

<!-- CONTENIDO CENTRAL -->

<div id="central">