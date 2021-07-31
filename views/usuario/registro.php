<h1>Registrate</h1>
<?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete') : ?>
    <strong class="alert_success">Registro completado correctamente</strong>
<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed') : ?>
    <strong class="alert_error">Registro Fallido,introduce bien los datos</strong>
<?php endif; ?>
<?php
Utils::deleteSession('register');
?>

<form action="<?= base_url ?>/usuario/guardar" method="post">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" required>
    <label for="apellidos">Apellidos</label>
    <input type="text" name="apellidos" id="apellidos" required>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>
    <label><input type="checkbox" name="admin" value="admin"> Usuario Administrador</label>
    <input type="submit" value="Registrarse">
</form>