<?php
namespace unapi\mailru\parser;

class Correspondents
{
    /** @var Recipient[] */
    private $from;
    /** @var Recipient[] */
    private $to;
    /** @var Recipient[] */
    private $cc;
    /** @var Recipient[] */
    private $bcc;

    /**
     * @param mixed $data
     */
    public function __construct($data)
    {
        $this->from = array_map(function($data) {
            return new Recipient($data);
        }, $data->from);
        $this->to = array_map(function($data) {
            return new Recipient($data);
        }, $data->to);
        $this->cc = [];
        $this->bcc = [];
    }

    /**
     * @return Recipient[]
     */
    public function getFrom(): array
    {
        return $this->from;
    }

    /**
     * @return Recipient[]
     */
    public function getTo(): array
    {
        return $this->to;
    }

    /**
     * @return Recipient[]
     */
    public function getCc(): array
    {
        return $this->cc;
    }

    /**
     * @return Recipient[]
     */
    public function getBcc(): array
    {
        return $this->bcc;
    }
}