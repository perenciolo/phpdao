<?php

class Usuario
{
    private $id;
    private $login;
    private $senha;
    private $reg_date;

    /**
     * Get the value of id.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id.
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of login.
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of login.
     *
     * @return self
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of senha.
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha.
     *
     * @return self
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get the value of reg_date.
     */
    public function getReg_date()
    {
        return $this->reg_date;
    }

    /**
     * Set the value of reg_date.
     *
     * @return self
     */
    public function setReg_date($reg_date)
    {
        $this->reg_date = $reg_date;

        return $this;
    }

    /**
     * Load User by a given ID.
     *
     * @param id type string
     *
     * @return user
     */
    public function loadById($id)
    {
        $sql = new DbConnection();

        $results = $sql->select('SELECT * FROM tb_usuarios WHERE id = :ID', array(
            ':ID' => $id,
        ));

        if (count($results) > 0) {
            $row = $results[0];

            $this->setId($row['id']);
            $this->setLogin($row['login']);
            $this->setSenha($row['senha']);
            $this->setReg_date(new DateTime($row['reg_date']));
        }
    }

    /**
     * Get all users.
     *
     * @return UsersList
     */
    public static function getList()
    {
        $sql = new DbConnection();

        return $sql->select('SELECT * FROM tb_usuarios ORDER BY `login`;');
    }

    /**
     * Search users by `login`.
     *
     * @param login type string
     *
     * @return UsersList
     */
    public static function search($login)
    {
        $sql = new DbConnection();

        return $sql->select('SELECT * FROM `tb_usuarios` WHERE `login` LIKE :LOGIN ORDER BY `login`', array(
            ':LOGIN' => '%'.$login.'%',
        ));
    }

    /**
     * Get user by `login` and `password`.
     *
     * @param login type string
     * @param password type string
     *
     * @return User
     */
    public function login($login, $password)
    {
        $sql = new DbConnection();

        $results = $sql->select('SELECT * FROM `tb_usuarios` WHERE `login` = :LOGIN AND `senha` = :PASSWD', array(
            ':LOGIN' => $login,
            ':PASSWD' => hash('sha256', $password),
        ));

        if (count($results) < 1) {
            throw new Exception('Login e/ou Senha invalidos.');
            die;
        }

        $row = $results[0];

        $this->setId($row['id']);
        $this->setLogin($row['login']);
        $this->setSenha($row['senha']);
        $this->setReg_date(new DateTime($row['reg_date']));
    }

    /**
     * Create User data JSON.
     *
     * @return userData
     */
    public function __toString()
    {
        return json_encode(array(
            'id' => $this->getId(),
            'login' => $this->getLogin(),
            'senha' => $this->getSenha(),
            'reg_date' => $this->getReg_date()->format('d/m/Y H:i:s'),
        ));
    }
}
