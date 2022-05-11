<?php


namespace App\Modules\Telegram\Updates\ChatMembers;


class NewChatMember
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

    public function user(): User
    {
        return new User($this->data['user']);
    }
}
