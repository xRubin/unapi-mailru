<?php
namespace unapi\mailru\parser;

use unapi\mailru\exceptions\ParserException;

class Body
{
    /** @var int */
    private $dateFirstLetter;
    /** @var int */
    private $messagesTotal;
    /** @var int */
    private $messagesUnread;
    /** @var Collector[] */
    private $collectors;
    /** @var Folder[] */
    private $folders;
    /** @var Thread[] */
    private $threads;

    /**
     * @param mixed $data
     */
    public function __construct($data)
    {
        if (!is_object($data))
            throw new ParserException('Broken body');

        $this->dateFirstLetter = $data->date_first_letter;
        $this->messagesTotal = $data->messages_total;
        $this->messagesUnread = $data->messages_unread;

        $this->collectors = $this->extractCollectors($data->collectors);
        $this->folders = $this->extractFolders($data->folders);
        $this->threads = $this->extractThreads($data->threads);
    }

    /**
     * @param $data
     * @return Collector[]
     */
    protected function extractCollectors($data): array
    {
        return [];
    }

    /**
     * @param $data
     * @return Folder[]
     */
    protected function extractFolders($data): array
    {
        $result = [];

        if (is_array($data))
            foreach ($data as $folder)
                $result[$folder->id] = new Folder($folder);

        return $result;
    }

    /**
     * @param $data
     * @return Thread[]
     */
    protected function extractThreads($data): array
    {
        $result = [];

        if (is_array($data))
            foreach ($data as $thread)
                $result[$thread->id] = (new Thread($thread));

        return $result;
    }

    /**
     * @return int
     */
    public function getDateFirstLetter(): int
    {
        return $this->dateFirstLetter;
    }

    /**
     * @return int
     */
    public function getMessagesTotal(): int
    {
        return $this->messagesTotal;
    }

    /**
     * @return int
     */
    public function getMessagesUnread(): int
    {
        return $this->messagesUnread;
    }

    /**
     * @return array
     */
    public function getCollectors(): array
    {
        return $this->collectors;
    }

    /**
     * @return array
     */
    public function getFolders(): array
    {
        return $this->folders;
    }

    /**
     * @return Thread[]
     */
    public function getThreads(): array
    {
        return $this->threads;
    }
}