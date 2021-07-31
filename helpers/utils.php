<?php
class Utils
{
    public static function deleteSession($name)
    {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name;
    }
    public static function isAdmin()
    {
        if (!isset($_SESSION['admin'])) {
            header('Location:' . base_url);
        } else {
            return true;
        }
    }
    public static function isAuthenticated()
    {
        if (!isset($_SESSION['identity'])) {
            header('Location:' . base_url);
        } else {
            return true;
        }
    }
    public static function isStock($id, $unidades)
    {
        require_once 'models/producto.php';
        $producto = new Producto();
        $resta = 0;
        $productoBus = $producto->getProduct($id);
        $resta = $productoBus->stock - $unidades;
        return $resta;
    }
    public static function showCategorias()
    {
        require_once 'models/categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        return $categorias;
    }
    public static function statsCarrito()
    {
        $stats = array(
            'count' => 0,
            'total' => 0
        );
        if (isset($_SESSION['carrito'])) {
            $stats['count'] = count($_SESSION['carrito']);
            foreach ($_SESSION['carrito'] as  $producto) {
                // var_dump($producto);
                $stats['total'] += $producto['precio'] * $producto['unidades'];
            }
        }
        return $stats;
    }
    public static function showStatus($status)
    {
        $value = 'Pendiente';
        switch ($status) {
            case 'confirm':
                $value = 'Pendiente';
                break;
            case 'preparation':
                $value = 'En Preparación';
                break;
            case 'ready':
                $value = 'Preparado';
                break;
            case 'sended':
                $value = 'Enviado';
        }
        return $value;
    }
}
