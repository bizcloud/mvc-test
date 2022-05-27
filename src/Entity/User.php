<?php


use Bizcloud\MVCTest\Functions;

class User
{
    private int $id;
    private string $name;
    private string $password;
    private string $salt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }


    /**
     * @param string $password
     */
    public function setStringPassword(string $password): void
    {
        $sault = Functions::generateRandomString(8);
        $password = md5($password . $sault);
        $this->salt = $sault;
        $this->password = $password;
    }


    /**
     * @return string
     */
    public function getSalt(): string
    {
        return $this->salt;
    }




}