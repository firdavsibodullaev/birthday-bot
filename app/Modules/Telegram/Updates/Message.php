<?php


namespace App\Modules\Telegram\Updates;

use App\Exceptions\ReplyToMessageException;
use App\Modules\Telegram\Exceptions\ContactException;
use App\Modules\Telegram\Exceptions\FileException;
use App\Modules\Telegram\Exceptions\LeftChatMemberException;
use App\Modules\Telegram\Exceptions\LeftChatParticipantException;
use App\Modules\Telegram\Updates\ChatMembers\LeftChatMember;
use App\Modules\Telegram\Updates\ChatMembers\LeftChatParticipant;

/**
 * Class Message
 * @package App\Modules\Telegram\Updates
 */
class Message
{
    /**
     * @var string[]
     */
    private $file_types = [
        'audio',
        'document',
        'photo',
        'video',
        'sticker',
        'voice',
        'animation',
    ];

    /**
     * @var array
     */
    private $message;

    /**
     * Message constructor.
     * @param array $message
     */
    public function __construct(array $message)
    {
        $this->message = $message;
    }

    /**
     * @return int
     */
    public function getMessageId(): int
    {
        return $this->message['message_id'];
    }

    /**
     * @return int
     */
    public function getDate(): int
    {
        return $this->message['date'];
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
     * @return string
     */
    public function getText(): string
    {
        return $this->message['text'] ?? ($this->message['caption'] ?? "");
    }

    /**
     * @return bool
     */
    public function isContact(): bool
    {
        return isset($this->message['contact']);
    }

    /**
     * @return Contact
     * @throws ContactException
     */
    public function contact(): Contact
    {
        if (!$this->isContact()) {
            throw new ContactException('Contact does no exist');
        }

        return new Contact($this->message['contact']);
    }

    /**
     * @param bool $is_strict
     * @return string
     * @throws ContactException
     */
    public function getContact(bool $is_strict = true): string
    {

        if ($is_strict && !$this->isContact()) {
            throw new ContactException('Contact does no exist');
        }

        return $this->isContact() ? $this->contact()->phoneNumber() : $this->getText();
    }

    /**
     * @return bool
     */
    public function isFile(): bool
    {
        foreach ($this->file_types as $file_type) {
            if (isset($this->message[$file_type])) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param array $file
     * @return File
     * @throws FileException
     */
    public function file(array $file = []): File
    {
        if (!$this->isFile()) {
            throw new FileException('File does not exist');
        }

        return new File(empty($file) ? $this->message : $file);
    }

    /**
     * @return LeftChatParticipant
     * @throws LeftChatParticipantException
     */
    public function leftChatParticipant(): LeftChatParticipant
    {
        if (!isset($this->message['left_chat_participant'])) {
            throw new LeftChatParticipantException('Left chat participant does not exist');
        }

        return new LeftChatParticipant($this->message['left_chat_participant']);
    }

    /**
     * @return LeftChatMember
     * @throws LeftChatMemberException
     */
    public function leftChatMember(): LeftChatMember
    {
        if (!isset($this->message['left_chat_member'])) {
            throw new LeftChatMemberException('Left chat member does not exist');
        }

        return new LeftChatMember($this->message['left_chat_member']);
    }

    /**
     * @return bool
     */
    public function isReplyToMessage(): bool
    {
        return isset($this->message['reply_to_message']);
    }

    /**
     * @return Message
     * @throws ReplyToMessageException
     */
    public function replyToMessage(): Message
    {
        if (!$this->isReplyToMessage()) {
            throw new ReplyToMessageException('Reply to message does not exist');
        }

        return new Message($this->message['reply_to_message']);
    }
}
