<?php

class Producto
{

    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
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
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);

        return $this;
    }
    /**
     * Get the value of categoria_id
     */
    public function getCategoria_id()
    {
        return $this->categoria_id;
    }

    /**
     * Set the value of categoria_id
     *
     * @return  self
     */
    public function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $this->db->real_escape_string($categoria_id);

        return $this;
    }
    /**
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $this->db->real_escape_string($descripcion);

        return $this;
    }

    /**
     * Get the value of precio
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */
    public function setPrecio($precio)
    {
        $this->precio = $this->db->real_escape_string($precio);

        return $this;
    }

    /**
     * Get the value of stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @return  self
     */
    public function setStock($stock)
    {
        $this->stock = $this->db->real_escape_string($stock);

        return $this;
    }

    /**
     * Get the value of oferta
     */
    public function getOferta()
    {
        return $this->oferta;
    }

    /**
     * Set the value of oferta
     *
     * @return  self
     */
    public function setOferta($oferta)
    {
        $this->oferta = $this->db->real_escape_string($oferta);

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
     * Get the value of imagen
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set the value of imagen
     *
     * @return  self
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getAllProducts()
    {
        $productos = $this->db->query("SELECT * FROM PRODUCTOS WHERE STOCK>0 ORDER BY ID ASC ");
        return $productos;
    }
    public function getAllProductsByCategoria()
    {
        $sql = "SELECT p.*, c.nombre AS 'nombreCat' FROM PRODUCTOS p ";
        $sql .= "INNER JOIN CATEGORIAS c ON p.categoria_id=c.id ";
        $sql .= "WHERE p.categoria_id={$this->getCategoria_id()} ";
        $sql .= "ORDER BY p.ID ASC";
        $productos = $this->db->query($sql);
        // echo $sql;
        // echo '<br/>';
        // echo $this->db->error;
        // die();
        return $productos;
    }
    public function getProduct($id)
    {
        $bus = $this->db->query("SELECT * FROM PRODUCTOS WHERE ID=$id");
        $producto = ($bus->num_rows > 0) ? $bus->fetch_object() : false;
        return $producto;
    }
    function getRandom($limit)
    {
        $productos = $this->db->query("SELECT * FROM PRODUCTOS ORDER BY RAND() LIMIT $limit");
        return $productos;
    }
    public function save()
    {
        $sql = "INSERT INTO PRODUCTOS VALUES(NULL,{$this->getCategoria_id()},'{$this->getNombre()}','{$this->getDescripcion()}',
        {$this->getPrecio()},{$this->getStock()},NULL,CURDATE(),'{$this->getImagen()}');";
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

    public function delete()
    {
        $sql = "DELETE FROM PRODUCTOS WHERE ID={$this->getId()}";
        $delete = $this->db->query($sql);
        $result = false;
        if ($delete) {
            $result = true;
        }
        return $result;
    }

    function edit()
    {
        $sql = "UPDATE PRODUCTOS SET CATEGORIA_ID={$this->getCategoria_id()},NOMBRE='{$this->getNombre()}',DESCRIPCION='{$this->getDescripcion()}',PRECIO={$this->getPrecio()},STOCK={$this->getStock()}";
        if ($this->getImagen() != null) {
            $sql .= ", IMAGEN='{$this->getImagen()}'";
        }
        $sql .= " WHERE ID={$this->getId()}";
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
