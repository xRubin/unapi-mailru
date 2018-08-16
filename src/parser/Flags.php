<?php
namespace unapi\mailru\parser;

class Flags
{
    /** @var bool */
    private $probableSpam;
    /** @var bool */
    private $stored;
    /** @var bool */
    private $readSet;
    /** @var bool */
    private $hideFastAnswers;
    /** @var bool */
    private $receipt;
    /** @var bool */
    private $safe;
    /** @var bool */
    private $pinned;
    /** @var bool */
    private $blacklistSpam;
    /** @var bool */
    private $dkim;
    /** @var bool */
    private $spf;
    /** @var bool */
    private $unread;
    /** @var bool */
    private $flagged;
    /** @var bool */
    private $reply;
    /** @var bool */
    private $forward;
    /** @var bool */
    private $attach;
    /** @var bool */
    private $wasntSent;
    /** @var bool */
    private $newsletter;

    /**
     * @param mixed $data
     */
    public function __construct($data)
    {
        $this->probableSpam = $data->probable_spam;
        $this->stored = $data->stored;
        $this->readSet = $data->read_set;
        $this->hideFastAnswers = $data->hide_fast_answers;
        $this->receipt = $data->receipt;
        $this->safe = $data->safe;
        $this->pinned = $data->pinned;
        $this->blacklistSpam = $data->blacklist_spam;
        $this->dkim = $data->dkim;
        $this->spf = $data->spf;
        $this->unread = $data->unread;
        $this->flagged = $data->flagged;
        $this->reply = $data->reply;
        $this->forward = $data->forward;
        $this->attach = $data->attach;
        $this->wasntSent = $data->wasnt_sent;
        $this->newsletter = $data->newsletter;
    }

    /**
     * @return bool
     */
    public function isProbableSpam(): bool
    {
        return $this->probableSpam;
    }

    /**
     * @return bool
     */
    public function isStored(): bool
    {
        return $this->stored;
    }

    /**
     * @return bool
     */
    public function isReadSet(): bool
    {
        return $this->readSet;
    }

    /**
     * @return bool
     */
    public function isHideFastAnswers(): bool
    {
        return $this->hideFastAnswers;
    }

    /**
     * @return bool
     */
    public function isReceipt(): bool
    {
        return $this->receipt;
    }

    /**
     * @return bool
     */
    public function isSafe(): bool
    {
        return $this->safe;
    }

    /**
     * @return bool
     */
    public function isPinned(): bool
    {
        return $this->pinned;
    }

    /**
     * @return bool
     */
    public function isBlacklistSpam(): bool
    {
        return $this->blacklistSpam;
    }

    /**
     * @return bool
     */
    public function isDkim(): bool
    {
        return $this->dkim;
    }

    /**
     * @return bool
     */
    public function isSpf(): bool
    {
        return $this->spf;
    }

    /**
     * @return bool
     */
    public function isUnread(): bool
    {
        return $this->unread;
    }

    /**
     * @return bool
     */
    public function isFlagged(): bool
    {
        return $this->flagged;
    }

    /**
     * @return bool
     */
    public function isReply(): bool
    {
        return $this->reply;
    }

    /**
     * @return bool
     */
    public function isForward(): bool
    {
        return $this->forward;
    }

    /**
     * @return bool
     */
    public function isAttach(): bool
    {
        return $this->attach;
    }

    /**
     * @return bool
     */
    public function wasntSent(): bool
    {
        return $this->wasntSent;
    }

    /**
     * @return bool
     */
    public function isNewsletter(): bool
    {
        return $this->newsletter;
    }
}