<?php
require_once "models/producto.php";
class CarritoController
{
    public function index()
    {
        $carrito = isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1  ? $_SESSION['carrito'] : false;
        require_once 'views/carrito/index.php';
    }
    public function add()
    {
        $counter = 0;

        if (isset($_GET['id'])) {
            $producto_id = $_GET['id'];
            //Conseguir el producto
            $producto = new Producto();
            $producto->setId($producto_id);
            $producto =  $producto->getProduct($producto_id);
        } else {
            header("Location:" . base_url);
        }

        if (isset($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $indice => $elemento) {
                if ($elemento['id_producto'] == $producto_id) {
                    if ($producto->stock > 0) {
                        $_SESSION['carrito'][$indice]['unidades']++;
                        $counter++;
                    }
                }
            }
        }
        if ($counter == 0 || !isset($counter)) {


            //Añadir al Carrito
            if (is_object($producto)) {
                //comprobar stock
                if ($producto->stock > 0) {
                    $_SESSION['carrito'][] = array(
                        "id_producto" => $producto->id,
                        "precio" => $producto->precio,
                        "unidades" => 1,
                        "producto" => $producto
                    );
                }
            }
        }
        header("Location:" . base_url . "carrito/index");
    }
    public function remove()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            unset($_SESSION['carrito'][$id]);
        }
        header("Location:" . base_url . "carrito/index");
    }
    public function increment()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            if ($_SESSION['carrito'][$id]['producto']->stock > 0) {
                $unidades = $_SESSION['carrito'][$id]['unidades'];
                if (Utils::isStock($_SESSION['carrito'][$id]['producto']->id, $unidades) > 0) {
                    $_SESSION['carrito'][$id]['unidades']++;
                } else {
                    $_SESSION['stock'] = $_SESSION['carrito'][$id]['producto']->nombre;
                }
            }
        }
        header("Location:" . base_url . "carrito/index");
    }
    public function decrement()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            if ($_SESSION['carrito'][$id]['producto']->stock > 0) {
                $_SESSION['carrito'][$id]['unidades']--;
                if ($_SESSION['carrito'][$id]['unidades'] == 0) {
                    unset($_SESSION['carrito'][$id]);
                }
            }
        }
        header("Location:" . base_url . "carrito/index");
    }
    public function deleteAll()
    {
        unset($_SESSION['carrito']);
        header("Location:" . base_url . "carrito/index");
    }
}
