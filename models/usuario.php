<?php

class Usuario
{

    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
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
        $this->nombre = $this->db->real_escape_string(trim($nombre));

        return $this;
    }

    /**
     * Get the value of apellidos
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set the value of apellidos
     *
     * @return  self
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $this->db->real_escape_string(trim($apellidos));

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $this->db->real_escape_string(trim($email));

        return $this;
    }

    /**
     * Get the value of password and encrypt
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = password_hash($this->db->real_escape_string(trim($password)), PASSWORD_BCRYPT, ['cost' => 4]);

        return $this;
    }

    /**
     * Get the value of rol
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set the value of rol
     *
     * @return  self
     */
    public function setRol($rol)
    {
        $this->rol = $this->db->real_escape_string($rol);

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
        $this->imagen = $this->db->real_escape_string(trim($imagen));

        return $this;
    }

    public function save()
    {
        $sql = "INSERT INTO USUARIOS VALUES(NULL,'{$this->getNombre()}','{$this->getApellidos()}','{$this->getEmail()}',
        '{$this->getPassword()}','{$this->getRol()}',NULL)";
        $save = $this->db->query($sql);
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function login($emailIn, $passwordIn)
    {
        if (isset($_SESSION['identity'])) {
            header("Location:" . base_url);
        }
        $result = false;
        $email = $emailIn;
        $password = $passwordIn;
        //Comprobar si existe el usuario
        $sql = "SELECT * FROM USUARIOS WHERE EMAIL='$email'";
        $login = $this->db->query($sql);
        if ($login && $login->num_rows == 1) {
            $usuario = $login->fetch_object();
            //Verificar la contraseña
            $verify = password_verify($password, $usuario->password);
            if ($verify) {
                $result = $usuario;
            }
        }
        return $result;
    }
}
