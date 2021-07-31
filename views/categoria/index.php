
<h1>Gestionar Categorias</h1>
<a href="<?= base_url ?>categoria/crear" class="button button-sm">Crear categoria</a>
<div style="overflow-x:auto;">
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>

            <?php while ($cate = $categorias->fetch_object()): ?>
                <tr> 
                    <td>
                        <?= $cate->id ?>
                    </td>
                    <td>
                        <?= $cate->nombre ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div >