<?php
require_once 'models/pedido.php';
require_once 'models/producto.php';
class PedidoController
{
    public function add()
    {
        require_once 'views/pedido/add.php';
    }
    public function save()
    {
        if (isset($_SESSION['identity'])) {

            // Obtener Datos
            $usuario_id = $_SESSION['identity']->id;
            $c_estado = isset($_POST['estado']) ? $_POST['estado'] : false;
            $c_estado = isset($_POST['estado']) ? $_POST['estado'] : false;
            $delegacion = isset($_POST['delegacion']) ? $_POST['delegacion'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $stats = Utils::statsCarrito();
            $coste = $stats['total'];

            //Guardar datos en BD
            if ($c_estado && $delegacion && $direccion) {

                $pedido = new Pedido();
                $pedido->setUsuario_id($usuario_id);
                $pedido->setC_estado($c_estado);
                $pedido->setDelegacion($delegacion);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);
                $producto = new Producto();
                foreach ($_SESSION['carrito'] as $id => $productoBus) {
                    $productoBus = $productoBus['producto'];
                    $resta = Utils::isStock($_SESSION['carrito'][$id]['producto']->id, $_SESSION['carrito'][$id]['unidades']);
                    if ($resta > 0) {
                        $producto->setId($productoBus->id);
                        $producto->setNombre($productoBus->nombre);
                        $producto->setDescripcion($productoBus->descripcion);
                        $producto->setPrecio($productoBus->precio);
                        $producto->setStock($resta);
                        $producto->setCategoria_id($productoBus->categoria_id);
                        $producto->edit();
                    } else {
                        $_SESSION['stock'] = $_SESSION['carrito'][$id]['producto']->nombre;
                        header("Location:" . base_url . "carrito/index");
                    }
                }

                $save = $pedido->save();
                // $guardar linea de pedido
                $save_linea = $pedido->save_linea();

                $_SESSION['pedido'] = $save && $save_linea ? "complete" : "failed";
            } else {
                $_SESSION['pedido'] = "failed";
            }
            header("Location:" . base_url . "pedido/confirmado");
        } else {
            //Redirigir al index
            header("Location:" . base_url);
        }
    }

    public function confirmado()
    {
        if (isset($_SESSION['identity'])) {
            $identity = $_SESSION['identity'];
            $pedido = new Pedido();
            $pedido->setUsuario_id($identity->id);
            $pedido = $pedido->getPedidoByUser();
            $productos = new Pedido();
            $productos = $productos->getProductByPedido($pedido->id);
            Utils::deleteSession('carrito');
            require_once 'views/pedido/confirmado.php';
        }
    }
    public function misPedidos()
    {
        Utils::isAuthenticated();
        $usuario_id = $_SESSION['identity']->id;
        $pedido = new Pedido();

        //Obtener pedidos del usuario
        $pedido->setUsuario_id($usuario_id);
        $pedidos = $pedido->getAllPedidoByUser();

        require_once 'views/pedido/mis_pedidos.php';
    }
    public function detalle()
    {
        Utils::isAuthenticated();
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
            //Obtener pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido = $pedido->getPedido();
            if ($pedido->usuario_id == $_SESSION['identity']->id || isset($_SESSION['admin'])) {

                //Obtener productos del pedido
                $productos = new Pedido();
                $productos = $productos->getProductByPedido($id);
                // var_dump($productos);
                // die();
                require_once 'views/pedido/detalle.php';
            } else {
                header("Location:" . base_url . "pedido/misPedidos");
            }
        } else {
            header("Location:" . base_url . "pedido/misPedidos");
        }
    }
    public function gestion()
    {
        Utils::isAdmin();
        $gestion = true;
        $pedido = new Pedido();

        $pedidos = $pedido->getAllPedidos();
        require_once 'views/pedido/mis_pedidos.php';
    }
    public function estado()
    {
        Utils::isAdmin();
        if (isset($_POST['pedido_id']) && isset($_POST['estado'])) {

            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];

            //Actualizar el pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido->setestado($estado);
            $pedido->updateStatus();
            header("Location:" . base_url . 'pedido/detalle&id=' . $id);
        } else {
            header("Location:" . base_url);
        }
    }
}
