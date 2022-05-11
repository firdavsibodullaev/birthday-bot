<?php

namespace App\Modules\Telegram\Updates\Channel;

class ChannelPost
{

    /**
     * @var array
     */
    protected $updates;

    /**
     * @param array $updates
     */
    public function __construct(array $updates)
    {
        $this->updates = $updates;
    }

    /**
     * @return Chat
     */
    public function chat(): Chat
    {
        return new Chat($this->updates['chat']);
    }

    /**
     * @return SenderChat
     */
    public function senderChat(): SenderChat
    {
        return new SenderChat($this->updates['sender_chat']);
    }
    /**
     * @return integer
     */
    public function messageId(): int
    {
        return $this->updates['message_id'];
    }

    /**
     * @return string
     */
    public function authorSignature(): string
    {
        return $this->updates['author_signature'];
    }

    /**
     * @return int
     */
    public function date(): int
    {
        return $this->updates['date'];
    }

    /**
     * @return string
     */
    public function text(): string
    {
        return $this->updates['text'];
    }
}
