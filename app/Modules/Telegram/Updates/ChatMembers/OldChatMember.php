<?php


namespace App\Modules\Telegram\Updates\ChatMembers;


class OldChatMember
{
    /**
     * @var array
     */
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function status(): string
    {
        return $this->data['status'];
    }

    /**
     * @return int
     */
    public function untilDate(): int
    {
        return $this->data['until_date'];
    }

    public function user(): User
    {
        return new User($this->data['user']);
    }
}
