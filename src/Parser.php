<?php
namespace unapi\mailru;

use function GuzzleHttp\json_decode;

class Parser
{
    /** @var mixed */
    private $content;

    /**
     * Parser constructor.
     * @param mixed $content
     */
    public function __construct(string $content)
    {
        $this->content = json_decode($content);

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

    public function getBody(): Body
    {
        return new Body($this->content->body);
    }
}

