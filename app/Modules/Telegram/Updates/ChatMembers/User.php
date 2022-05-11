<?php


namespace App\Modules\Telegram\Updates\ChatMembers;


class User
{

    /**
     * @var array
     */
    private $user;

    public function __construct(array $user)
    {
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->user['id'];
    }

    /**
     * @return bool
     */
    public function isBot(): bool
    {
        return $this->user['is_bot'];
    }

    /**
     * @return string
     */
    public function firstName(): string
    {
        return $this->user['first_name'];
    }

    /**
     * @return string
     */
    public function username(): string
    {
        return $this->user['username'];
    }
}
