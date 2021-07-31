    <?php if (isset($edit) && isset($busProdu) && is_object($busProdu)) :
        $url_action = base_url . "producto/save&id=" . $busProdu->id;
    ?>
        <h1>Editar Producto <?= $busProdu->nombre ?></h1>
    <?php else :
        $url_action = base_url . "producto/save";
    ?>
        <h1>Crear Nuevo Producto</h1>
    <?php endif; ?>
    <div class="form-container">
        <?php
        ?>
        <form action="<?= $url_action ?>" method="post" enctype="multipart/form-data">

            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?= isset($busProdu) && is_object($busProdu) ? $busProdu->nombre : '' ?>">
            <label for="descripcion">Descripción</label>
            <textarea type="text" name="descripcion" id="descripcion"><?= isset($busProdu) && is_object($busProdu) ? $busProdu->descripcion : '' ?></textarea>
            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio" value="<?= isset($busProdu) && is_object($busProdu) ? $busProdu->precio : 0 ?>">
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" value="<?= isset($busProdu) && is_object($busProdu) ? $busProdu->stock : 0 ?>">
            <label for="categoria">Categoria</label>
            <?php $categoria = Utils::showCategorias(); ?>
            <select name="categoria" id="categoria">
                <?php while ($cat = $categoria->fetch_object()) : ?>
                    <option value="<?= $cat->id ?>" <?= isset($busProdu) && is_object($busProdu) && $cat->id == $busProdu->categoria_id ? 'selected' : '' ?>><?= $cat->nombre ?></option>
                <?php endwhile; ?>
            </select>
            <label for="imagen">Imagen</label>
            <?php if (isset($busProdu) && is_object($busProdu) && !empty($busProdu->imagen)) : ?>
                <img src="<?= base_url ?>uploads/images/<?= $busProdu->imagen ?> ?>" class="thumb" />
            <?php endif; ?>
            <input type="file" name="imagen" id="imagen">
            <input type="submit" value="Guardar">
        </form>
    </div>