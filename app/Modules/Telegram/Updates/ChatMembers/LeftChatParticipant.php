<?php

namespace App\Modules\Telegram\Updates\ChatMembers;

class LeftChatParticipant
{

    /**
     * @var array
     */
    private $participant;

    /**
     * @param array $participant
     */
    public function __construct(array $participant)
    {
        $this->participant = $participant;
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->participant['id'];
    }

    /**
     * @return bool
     */
    public function isBot(): bool
    {
        return $this->participant['is_bot'];
    }

    /**
     * @return string
     */
    public function firstName(): string
    {
        return $this->participant['first_name'];
    }

    /**
     * @return string
     */
    public function languageCode(): string
    {
        return $this->participant['language_code'];
    }
}
