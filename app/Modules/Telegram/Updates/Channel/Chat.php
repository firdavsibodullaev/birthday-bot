<?php

namespace App\Modules\Telegram\Updates\Channel;

class Chat
{

    /**
     * @var array
     */
    private $chat;

    /**
     * @param array $chat
     */
    public function __construct(array $chat)
    {
        $this->chat = $chat;
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->chat['id'];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->chat['title'];
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->chat['type'];
    }
}
