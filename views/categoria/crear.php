<h1>Crear Nueva Categoria</h1>
<form action="<?= base_url ?>categoria/save" method="POST">
    <label for="nombreC">Nombre de la Categoria</label>
    <input type="text" name="nombreC" required/>
    <input type="submit" value="Guardar"/>
</form>