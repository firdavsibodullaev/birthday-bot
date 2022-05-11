<?php

namespace App\Modules\Telegram\Updates;

class ChatMember
{
    /**
     * @var array
     */
    private $update;

    public function __construct(array $update)
    {
        $this->update = $update;
    }
}
