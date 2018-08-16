<?php
namespace unapi\mailru\parser;

use function GuzzleHttp\json_decode;
use unapi\mailru\exceptions\ParserException;

class Mailbox
{
    /** @var mixed */
    private $content;

    /**
     * @param mixed $data
     */
    public function __construct(string $data)
    {
        $this->content = json_decode($data);

        if ($this->getStatus() !== 200)
            throw new ParserException($this->getStatus());
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->content->status;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->content->email;
    }

    /**
     * @return bool
     */
    public function getHtmlEncoded(): bool
    {
        return $this->content->htmlencoded;
    }

    /**
     * @return Body
     */
    public function getBody(): Body
    {
        return new Body($this->content->body);
    }
}

