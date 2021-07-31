<?php

class Pedido
{

    private $id;
    private $usuario_id;
    private $c_estado;
    private $delegacion;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    private $db;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->db = Database::connect();
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of usuario_id
     */
    public function getUsuario_id()
    {
        return $this->usuario_id;
    }

    /**
     * Set the value of usuario_id
     *
     * @return  self
     */
    public function setUsuario_id($usuario_id)
    {
        $this->usuario_id = $usuario_id;

        return $this;
    }

    /**
     * Get the value of c_estado
     */
    public function getC_estado()
    {
        return $this->c_estado;
    }

    /**
     * Set the value of c_estado
     *
     * @return  self
     */
    public function setC_estado($c_estado)
    {
        $this->c_estado = $this->db->real_escape_string($c_estado);

        return $this;
    }

    /**
     * Get the value of delegacion
     */
    public function getDelegacion()
    {
        return $this->delegacion;
    }

    /**
     * Set the value of delegacion
     *
     * @return  self
     */
    public function setDelegacion($delegacion)
    {
        $this->delegacion = $this->db->real_escape_string($delegacion);

        return $this;
    }

    /**
     * Get the value of direccion
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $this->db->real_escape_string($direccion);

        return $this;
    }

    /**
     * Get the value of coste
     */
    public function getCoste()
    {
        return $this->coste;
    }

    /**
     * Set the value of coste
     *
     * @return  self
     */
    public function setCoste($coste)
    {
        $this->coste = $coste;

        return $this;
    }

    /**
     * Get the value of estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get the value of fecha
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of hora
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set the value of hora
     *
     * @return  self
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }


    public function getAllPedidos()
    {

        $pedidos = $this->db->query("SELECT * FROM PEDIDOS ORDER BY ID ASC");
        return $pedidos;
    }
    public function getPedido()
    {
        $sql = "SELECT p.*,u.id as 'usuarioId',CONCAT(u.nombre,' ',u.apellidos) as 'nombreU',u.email FROM PEDIDOS p"
            . " INNER JOIN USUARIOS u ON p.usuario_id= u.id"
            . " WHERE p.ID={$this->getId()}";
        $bus = $this->db->query($sql);
        $pedido = $bus->num_rows >= 0 ? $bus->fetch_object() : false;
        return $pedido;
    }

    public function getPedidoByUser()
    {
        $sql = "SELECT P.id,p.coste FROM PEDIDOS P  " .
            // "INNER JOIN LINEAS_PEDIDOS lp ON lp.PEDIDO_ID=P.ID " .
            "WHERE P.USUARIO_ID={$this->getUsuario_id()} ORDER BY ID DESC LIMIT 1";
        $bus = $this->db->query($sql);
        $pedido =    $bus->num_rows >= 0 ? $bus->fetch_object() : false;
        return $pedido;
    }

    public function getAllPedidoByUser()
    {
        $sql = "SELECT * FROM PEDIDOS " .
            "WHERE USUARIO_ID={$this->getUsuario_id()} ORDER BY ID DESC";
        $bus = $this->db->query($sql);
        $pedidos = $bus->num_rows >= 0 ? $bus : false;
        return $pedidos;
    }

    public function getProductByPedido($ID)
    {
        $sql = "SELECT pr.*, lp.unidades FROM PRODUCTOS pr" .
            " INNER JOIN LINEAS_PEDIDOS lp ON pr.id = lp.producto_id" .
            " WHERE lp.pedido_id={$ID} ";
        $bus = $this->db->query($sql);
        $productos = $bus->num_rows >= 0 ? $bus : false;
        return $productos;
    }

    public function save()
    {
        $sql = "INSERT INTO PEDIDOS VALUES(NULL,{$this->getUsuario_id()},'{$this->getC_estado()}','{$this->getDelegacion()}','{$this->getDireccion()}',{$this->getCoste()},'confirm',CURDATE(),CURTIME())";
        $save = $this->db->query($sql);
        // echo $sql;
        // die();
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function save_linea()
    {
        $sql = "SELECT LAST_INSERT_ID() AS 'pedido';";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;
        foreach ($_SESSION['carrito'] as  $elemento) {
            $producto = $elemento['producto'];
            if ($producto->stock > 0) {
                $insert = "INSERT INTO LINEAS_PEDIDOS VALUES(NULL,{$pedido_id},{$producto->id},{$elemento['unidades']})";
                $save = $this->db->query($insert);
            }
        }
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }
    function updateStatus()
    {
        $sql = "UPDATE pedidos SET estado ='{$this->getEstado()}'";
        $sql .= " WHERE id={$this->getId()}";
        $save = $this->db->query($sql);
        // echo $sql;
        // echo '<br/>';
        // echo $this->db->error;
        // die();
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }
}
