<?php
namespace unapi\mailru\parser;

class Recipient
{
    /** @var string */
    private $email;
    /** @var string */
    private $name;

    /**
     * @param mixed $data
     */
    public function __construct($data)
    {
        $this->email = $data->email;
        $this->name = $data->name;
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
    public function getName(): string
    {
        return $this->name;
    }
}