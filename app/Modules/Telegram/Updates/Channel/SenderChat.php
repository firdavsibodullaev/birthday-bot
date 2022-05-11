<?php

namespace App\Modules\Telegram\Updates\Channel;

class SenderChat
{

    /**
     * @var array
     */
    private $sender_chat;

    public function __construct(array $sender_chat)
    {
        $this->sender_chat = $sender_chat;
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->sender_chat['id'];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->sender_chat['title'];
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->sender_chat['type'];
    }
}
