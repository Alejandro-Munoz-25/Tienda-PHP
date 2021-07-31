<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/styles.css">
    <title>Tienda PHP</title>
</head>

<body>
    <div id="container">
        <!-- CABECERA -->
        <header id="header">
            <div id="logo">
                <img src="<?= base_url ?>assets/images/camiseta.png" alt="Camiseta Logo">
                <a href="<?= base_url ?>">
                    <h1>Tienda de Camisetas</h1>
                </a>
            </div>
        </header>

        <!-- MENU -->
        <nav id="menu">
            <ul>
                <?php $categorias = Utils::showCategorias(); ?>
                <li>
                    <a href="<?= base_url ?>">Inicio</a>
                </li>
                <?php while ($cat = $categorias->fetch_object()) : ?>
                    <li>
                        <a href="<?= base_url ?>categoria/ver&id=<?= $cat->id ?>"><?= $cat->nombre ?></a>
                    </li>
                <?php endwhile; ?>

            </ul>
        </nav>
        <div id="content">