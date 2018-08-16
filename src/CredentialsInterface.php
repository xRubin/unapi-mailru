<?php
namespace unapi\mailru;

interface CredentialsInterface
{
    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @return string
     */
    public function getLogin(): string;

    /**
     * @return string
     */
    public function getDomain(): string;

    /**
     * @return string
     */
    public function getPassword(): string;
}
