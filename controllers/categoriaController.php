<?php

require_once 'models/categoria.php';
require_once 'models/producto.php';

class CategoriaController
{

    public function index()
    {
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        require_once 'views/categoria/index.php';
    }

    public function crear()
    {
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }

    public function save()
    {
        Utils::isAdmin();
        if (isset($_POST) && isset($_POST['nombreC'])) {
            header('Location:' . base_url . 'categoria/index');
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombreC']);
            $categoria->save();
        }
    }
    function ver()
    {
        if (isset($_GET['id'])) {
            //conseguir categoria
            $id = $_GET['id'];
            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria = $categoria->getOne();
            //conseguir productos
            $producto = new Producto();
            $producto->setCategoria_id($id);
            $productos = $producto->getAllProductsByCategoria();
        }
        require_once "views/categoria/ver.php";
    }
}
