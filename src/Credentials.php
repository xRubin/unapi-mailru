<?php
namespace unapi\mailru;

class Credentials implements CredentialsInterface
{
    /** @var string */
    private $email;
    /** @var string */
    private $login;
    /** @var string */
    private $domain;
    /** @var string */
    private $password;

    /**
     * @param string $email
     * @param string $password
     */
    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        list($this->login, $this->domain) = explode('@', $email, 2);
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
