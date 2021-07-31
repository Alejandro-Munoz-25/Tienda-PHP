<?php
require_once 'models/producto.php';
class ProductoController
{
    public function index()
    {
        $producto = new Producto();
        $productos = $producto->getRandom(6);
        //renderizar vista
        require_once 'views/productos/destacados.php';
    }
    public function gestion()
    {
        Utils::isAdmin();
        $producto = new Producto();
        $productos = $producto->getAllProducts();
        require_once 'views/productos/gestion.php';
    }
    public function crear()
    {
        Utils::isAdmin();
        require_once 'views/productos/crear.php';
    }
    public function save()
    {
        Utils::isAdmin();
        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            // $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;
            if ($nombre && $descripcion && $precio && $stock && $categoria) {
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);
                // Guardar la imagen
                if (isset($_FILES['imagen']) && $_FILES['imagen']['name'] != null) {

                    $file = $_FILES['imagen'];
                    $filename = $file['name'];
                    $type = $file['type'];
                    if ($type == 'image/jpeg' || $type == 'image/png' || $type = 'image/gif') {
                        if (!is_dir('uploads/images')) {
                            mkdir('uploads/images', 0777, true);
                        }
                        if (isset($_GET['id'])) {
                            $ima = $producto->getProduct($_GET['id']);

                            if ($ima->imagen != null) unlink("./uploads/images/" . $ima->imagen);
                        }

                        move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                        $producto->setImagen($filename);
                    }
                }
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $save = $producto->edit();
                } else {
                    $save = $producto->save();
                }

                if ($save) {
                    $_SESSION['producto'] = 'complete';
                } else {
                    $_SESSION['producto'] = 'failed';
                }
            } else {
                $_SESSION['producto'] = 'failed';
            }
        } else {
            $_SESSION['producto'] = 'failed';
        }

        header("Location:" . base_url . 'producto/gestion');
    }

    function editar()
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $edit = true;
            $producto = new Producto();
            $id = ($_GET['id']);

            if ($producto->getProduct($id)) {
                $busProdu = $producto->getProduct($id);
                require_once 'views/productos/crear.php';
            } else {
                header("Location:" . base_url . '/producto/gestion');
            }
        } else {
            header("Location:" . base_url . '/producto/gestion');
        }
    }
    function eliminar()
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $producto = new Producto();
            $id = ($_GET['id']);
            if ($producto->getProduct($id)) {
                $producto->setId($_GET['id']);
                $delete = $producto->delete();
                $_SESSION['delete'] = $delete ? "complete" : "failed";
            } else {
                $_SESSION['delete'] = "noExist";
            }
        }
        header("Location:" . base_url . '/producto/gestion');
    }
    function show()
    {
        if (isset($_GET['id'])) {
            $id = ($_GET['id']);
            $producto = new Producto();
            $produ = $producto->getProduct($id);
            require_once 'views/productos/ver.php';
        }
    }
}
