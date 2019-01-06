<?php

class Usuario
{
    private $id;
    private $login;
    private $senha;
    private $reg_date;

    public function __construct($login = '', $password = '')
    {
        $this->setLogin($login);
        $this->setSenha($password);
    }

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
     */
    public function loadById($id): void
    {
        $results = Usuario::exeSelect('SELECT * FROM tb_usuarios WHERE id = :ID', array(
            ':ID' => $id,
        ));

        if (count($results) < 1) {
            throw new Exception('Erro, id inexistente');
        }

        $this->setData($results[0]);
    }

    /**
     * Get all users.
     *
     * @return UsersList
     */
    public static function getList()
    {
        return json_encode(Usuario::exeSelect('SELECT * FROM tb_usuarios ORDER BY `login`;')[0]);
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
        return json_encode(Usuario::exeSelect('SELECT * FROM `tb_usuarios` WHERE `login` LIKE :LOGIN ORDER BY `login`', array(
            ':LOGIN' => '%'.$login.'%',
        ))[0]);
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
        $results = Usuario::exeSelect('SELECT * FROM `tb_usuarios` WHERE `login` = :LOGIN AND `senha` = :PASSWD', array(
            ':LOGIN' => $login,
            ':PASSWD' => hash('sha256', $password),
        ));

        if (count($results) < 1) {
            throw new Exception('Login e/ou Senha invalidos.');
            die;
        }

        $this->setData($results[0]);
    }

    public function insert()
    {
        $results = Usuario::exeSelect('CALL sp_usuarios_insert(:LOGIN, :PASSWD)', array(
            ':LOGIN' => $this->getLogin(),
            ':PASSWD' => $this->getSenha(),
        ));

        if (count($results) < 1) {
            throw new Exception('Erro ao inserir no banco de dados');
        }

        $this->setData($results[0]);
    }

    /**
     * Update database data.
     *
     * @param login type string
     * @param senha type string
     */
    public function update($login, $senha): void
    {
        $this->setLogin($login);
        $this->setSenha($senha);

        $sql = new DbConnection();

        $sql->query('UPDATE tb_usuarios SET login = :LOGIN, senha = :PASSWD WHERE id = :ID', array(
            ':LOGIN' => $this->getLogin(),
            ':PASSWD' => $this->getSenha(),
            ':ID' => $this->getId(),
        ));
    }

    /**
     * Delete from database data.
     */
    public function delete()
    {
        $sql = new DbConnection();

        $sql->query('DELETE FROM tb_usuarios WHERE id = :ID', array(
            ':ID' => $this->getId(),
        ));

        $this->setId(null);
        $this->setLogin(null);
        $this->setSenha(null);
        $this->setReg_date(null);
    }

    /**
     * Static select DAO method.
     *
     * @param rawQuery type string
     * @param params type array
     */
    private static function exeSelect($rawQuery, $params = array())
    {
        $sql = new DbConnection();

        return $sql->select($rawQuery, $params);
    }

    /**
     * Set values to the class attributes method.
     *
     * @param data type array
     */
    private function setData($data): void
    {
        $this->setId($data['id']);
        $this->setLogin($data['login']);
        $this->setSenha($data['senha']);
        $this->setReg_date(new DateTime($data['reg_data']));
    }

    /**
     * Create User data JSON.
     *
     * @return userData
     */
    public function __toString(): string
    {
        if (!$this->getId() && !$this->getLogin() && !$this->getSenha() && !$this->getReg_date()) {
            return '{}';
        }

        return json_encode(array(
            'id' => $this->getId(),
            'login' => $this->getLogin(),
            'senha' => $this->getSenha(),
            'reg_date' => $this->getReg_date()->format('d/m/Y H:i:s'),
        ));
    }
}
