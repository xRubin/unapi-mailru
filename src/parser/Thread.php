<?php
namespace unapi\mailru\parser;

class Thread
{
    /** @var string */
    private $id;
    /** @var string|null */
    private $prev;
    /** @var string|null */
    private $next;
    /** @var string */
    private $last;
    /** @var string */
    private $expand;
    /** @var int */
    private $length;
    /** @var int */
    private $lengthUnread;
    /** @var int */
    private $lengthFlagged;
    /** @var Flags */
    private $flags;
    /** @var string */
    private $subject;
    /** @var int */
    private $priority;
    /** @var int */
    private $date;
    /** @var int */
    private $size;
    /** @var string */
    private $folder;
    /** @var string */
    private $snippet;
    /** @var Correspondents */
    private $correspondents;
    /** @var int|null */
    private $snoozeDate;

    /**
     * @param mixed $data
     */
    public function __construct($data)
    {
        $this->id = $data->id;
        $this->prev = $data->prev;
        $this->next = $data->next;
        $this->last = $data->last;
        $this->expand = $data->expand;
        $this->length = $data->length;
        $this->lengthUnread = $data->length_unread;
        $this->lengthFlagged = $data->length_flagged;
        $this->flags = new Flags($data->flags);
        $this->subject = $data->subject;
        $this->priority = $data->priority;
        $this->date = $data->date;
        $this->size = $data->size;
        $this->folder = $data->folder;
        $this->snippet = $data->snippet;
        $this->correspondents = new Correspondents($data->correspondents);
        $this->snoozeDate = $data->snooze_date;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getPrev(): ?string
    {
        return $this->prev;
    }

    /**
     * @return null|string
     */
    public function getNext(): ?string
    {
        return $this->next;
    }

    /**
     * @return string
     */
    public function getLast(): string
    {
        return $this->last;
    }

    /**
     * @return string
     */
    public function getExpand(): string
    {
        return $this->expand;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @return int
     */
    public function getLengthUnread(): int
    {
        return $this->lengthUnread;
    }

    /**
     * @return int
     */
    public function getLengthFlagged(): int
    {
        return $this->lengthFlagged;
    }

    /**
     * @return Flags
     */
    public function getFlags(): Flags
    {
        return $this->flags;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @return int
     */
    public function getDate(): int
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getFolder(): string
    {
        return $this->folder;
    }

    /**
     * @return string
     */
    public function getSnippet(): string
    {
        return $this->snippet;
    }

    /**
     * @return Correspondents
     */
    public function getCorrespondents(): Correspondents
    {
        return $this->correspondents;
    }

    /**
     * @return int|null
     */
    public function getSnoozeDate(): ?int
    {
        return $this->snoozeDate;
    }
}