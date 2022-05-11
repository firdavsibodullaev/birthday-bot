<?php


namespace App\Modules\Telegram\Updates;


use App\Modules\Telegram\Updates\ChatMembers\NewChatMember;
use App\Modules\Telegram\Updates\ChatMembers\OldChatMember;

class MyChatMember
{
    /**
     * @var array
     */
    private $message;

    public function __construct(array $message)
    {
        $this->message = $message;
    }

    /**
     * @return Chat
     */
    public function chat(): Chat
    {
        return new Chat($this->message['chat']);
    }

    /**
     * @return From
     */
    public function from(): From
    {
        return new From($this->message['from']);
    }

    /**
     * @return int
     */
    public function getDate(): int
    {
        return $this->message['date'];
    }

    public function oldChatMember(): OldChatMember
    {
        return new OldChatMember($this->message['old_chat_member']);
    }

    public function newChatMember(): NewChatMember
    {
        return new NewChatMember($this->message['new_chat_member']);
    }
}
