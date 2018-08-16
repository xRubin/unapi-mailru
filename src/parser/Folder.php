<?php

namespace unapi\mailru\parser;

class Folder
{
    /** @var string */
    private $id;
    /** @var bool */
    private $system;
    /** @var string */
    private $type;
    /** @var string */
    private $name;
    /** @var int */
    private $messagesUnread;
    /** @var int */
    private $messagesTotal;
    /** @var bool */
    private $security;
    /** @var bool */
    private $open;
    /** @var bool */
    private $onlyWeb;
    /** @var string */
    private $parent;
    /** @var bool */
    private $child;
    /** @var bool */
    private $children;
    /** @var bool */
    private $archive;
    /** @var int */
    private $lastVisit;
    /** @var int */
    private $messagesPinned;
    /** @var int */
    private $messagesSnoozed;
    /** @var int */
    private $messagesFlagged;
    /** @var int */
    private $messagesWithAttachments;

    /**
     * @param mixed $data
     */
    public function __construct($data)
    {
        $this->id = $data->id;
        $this->system = $data->system;
        $this->type = $data->type;
        $this->name = $data->name;
        $this->messagesUnread = $data->messages_unread;
        $this->messagesTotal = $data->messages_total;
        $this->security = $data->security;
        $this->open = $data->open;
        $this->onlyWeb = $data->only_web;
        $this->parent = $data->parent;
        $this->child = $data->child;
        $this->children = $data->children;
        $this->archive = $data->archive;
        $this->lastVisit = $data->last_visit;
        $this->messagesPinned = $data->messages_pinned;
        $this->messagesSnoozed = $data->messages_snoozed;
        $this->messagesFlagged = $data->messages_flagged;
        $this->messagesWithAttachments = $data->messages_with_attachments;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isSystem(): bool
    {
        return $this->system;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getMessagesUnread(): int
    {
        return $this->messagesUnread;
    }

    /**
     * @return int
     */
    public function getMessagesTotal(): int
    {
        return $this->messagesTotal;
    }

    /**
     * @return bool
     */
    public function isSecurity(): bool
    {
        return $this->security;
    }

    /**
     * @return bool
     */
    public function isOpen(): bool
    {
        return $this->open;
    }

    /**
     * @return bool
     */
    public function isOnlyWeb(): bool
    {
        return $this->onlyWeb;
    }

    /**
     * @return string
     */
    public function getParent(): string
    {
        return $this->parent;
    }

    /**
     * @return bool
     */
    public function isChild(): bool
    {
        return $this->child;
    }

    /**
     * @return bool
     */
    public function isChildren(): bool
    {
        return $this->children;
    }

    /**
     * @return bool
     */
    public function isArchive(): bool
    {
        return $this->archive;
    }

    /**
     * @return int
     */
    public function getLastVisit(): int
    {
        return $this->lastVisit;
    }

    /**
     * @return int
     */
    public function getMessagesPinned(): int
    {
        return $this->messagesPinned;
    }

    /**
     * @return int
     */
    public function getMessagesSnoozed(): int
    {
        return $this->messagesSnoozed;
    }

    /**
     * @return int
     */
    public function getMessagesFlagged(): int
    {
        return $this->messagesFlagged;
    }

    /**
     * @return int
     */
    public function getMessagesWithAttachments(): int
    {
        return $this->messagesWithAttachments;
    }
}