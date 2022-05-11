<?php

namespace App\Modules\Telegram\Updates\Channel;

class EditedChannelPost extends ChannelPost
{
    public function __construct(array $updates)
    {
        parent::__construct($updates);
    }

    /**
     * @return int
     */
    public function editDate(): int
    {
        return $this->updates['edit_date'];
    }
}
