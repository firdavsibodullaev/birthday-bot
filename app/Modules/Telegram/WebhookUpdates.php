<?php


namespace App\Modules\Telegram;


use App\Modules\Telegram\Constants\ChatTypeConstant;
use App\Modules\Telegram\Constants\UpdateMethodConstant;
use App\Modules\Telegram\Exceptions\CallbackQueryException;
use App\Modules\Telegram\Exceptions\ChannelException;
use App\Modules\Telegram\Exceptions\MessageException;
use App\Modules\Telegram\Exceptions\MyChatMemberException;
use App\Modules\Telegram\Updates\CallbackQuery;
use App\Modules\Telegram\Updates\Channel\ChannelPost;
use App\Modules\Telegram\Updates\Channel\EditedChannelPost;
use App\Modules\Telegram\Updates\Message;
use App\Modules\Telegram\Updates\MyChatMember;
use Exception;

class WebhookUpdates
{

    /**
     * @var mixed
     */
    private $updates;

    private $update_methods = [
        'message',
        'edited_message',
        'channel_post',
        'edited_channel_post',
        'inline_query',
        'callback_query',
        'shipping_query',
        'my_chat_member',
        'chat_member',
    ];

    /** @var integer */
    public $update_id;

    /**
     * WebhookUpdates constructor.
     * @param array $updates
     */
    public function __construct(array $updates)
    {
        $this->updates = $updates;

        $this->update_id = $updates['update_id'];
    }

    public function json()
    {
        return $this->updates;
    }

    public function body()
    {
        return json_encode($this->updates);
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {

        $update = $this->json();
        unset($update['update_id']);

        return array_keys($update)[0];
    }

    /**
     * @return Message
     * @throws MessageException
     */
    public function message(): Message
    {
        if ($this->getMethod() !== UpdateMethodConstant::MESSAGE) {
            throw new MessageException('Message does not exist');
        }

        return new Message($this->updates['message']);
    }

    /**
     * @return Message
     */
    public function editedMessage(): Message
    {
        return new Message($this->updates[UpdateMethodConstant::EDITED_MESSAGE]);
    }

    /**
     * @return bool
     */
    public function isCallbackQuery(): bool
    {
        return $this->getMethod() === UpdateMethodConstant::CALLBACK_QUERY;
    }

    /**
     * @throws CallbackQueryException
     */
    public function callbackQuery(): CallbackQuery
    {
        if ($this->getMethod() !== UpdateMethodConstant::CALLBACK_QUERY) {
            throw new CallbackQueryException('Callback query does not exist');
        }

        return new CallbackQuery($this->updates['callback_query']);
    }

    /**
     * @return bool
     */
    public function isChatMember(): bool
    {
        return isset($this->updates['my_chat_member']);
    }

    /**
     * @return MyChatMember
     * @throws MyChatMemberException
     */
    public function myChatMember(): MyChatMember
    {
        if ($this->getMethod() !== UpdateMethodConstant::MY_CHAT_MEMBER) {
            throw new MyChatMemberException('My chat member does not exist');
        }
        return new MyChatMember($this->updates['my_chat_member']);
    }

    /**
     * @return null|int
     * @throws CallbackQueryException
     * @throws MessageException
     * @throws MyChatMemberException
     */
    public function chat(): ?int
    {
        switch ($this->getMethod()) {
            case UpdateMethodConstant::MESSAGE:
                return $this->message()->chat()->id();
            case UpdateMethodConstant::MY_CHAT_MEMBER:
                return $this->myChatMember()->chat()->id();
            case UpdateMethodConstant::CALLBACK_QUERY:
                return $this->callbackQuery()->message()->chat()->id();
            default:
                return null;
        }
    }

    /**
     * @return int
     * @throws CallbackQueryException
     * @throws MessageException
     * @throws MyChatMemberException
     */
    public function from(): int
    {
        switch ($this->getMethod()) {
            case UpdateMethodConstant::MESSAGE:
                return $this->message()->from()->id();
            case UpdateMethodConstant::MY_CHAT_MEMBER:
                return $this->myChatMember()->from()->id();
            case UpdateMethodConstant::CALLBACK_QUERY:
                return $this->callbackQuery()->message()->from()->id();
            default:
                return 0;
        }
    }

    /**
     * @return null|string
     * @throws CallbackQueryException
     * @throws MessageException
     * @throws ChannelException
     */
    public function text(): ?string
    {
        switch ($this->getMethod()) {
            case UpdateMethodConstant::MESSAGE:
                return $this->message()->getText();
            case UpdateMethodConstant::CALLBACK_QUERY:
                return $this->callbackQuery()->message()->getText();
            case UpdateMethodConstant::CHANNEL_POST:
                return $this->channelPost()->text();
            default:
                return null;
        }
    }

    /**
     * @throws ChannelException
     * @throws MessageException
     * @throws CallbackQueryException
     * @throws MyChatMemberException
     */
    public function getType()
    {
        // ToDo make get type for chat members

        switch ($this->getMethod()) {
            case UpdateMethodConstant::MESSAGE:
                return $this->message()->chat()->type();
            case UpdateMethodConstant::CALLBACK_QUERY:
                return $this->callbackQuery()->message()->chat()->type();
            case UpdateMethodConstant::CHANNEL_POST:
                return $this->channelPost()->chat()->type();
            case UpdateMethodConstant::EDITED_CHANNEL_POST:
                return $this->editedChannelPost()->chat()->type();
            case UpdateMethodConstant::MY_CHAT_MEMBER:
                return $this->myChatMember()->chat()->type();
        }

        return '';
    }


    /**
     * @return bool
     */
    public function isPrivate(): bool
    {
        try {

            return $this->getType() === ChatTypeConstant::PRIVATE;

        } catch (Exception $e) {

            return false;

        }
    }


    /**
     * @return bool
     */
    public function isChannel(): bool
    {
        try {
            return $this->getType() === ChatTypeConstant::CHANNEL;
        } catch (Exception $e) {
            return false;
        }

    }

    /**
     * @return bool
     */
    public function isGroup(): bool
    {
        try {
            return in_array($this->getType(), [ChatTypeConstant::GROUP, ChatTypeConstant::SUPERGROUP]);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @return ChannelPost
     * @throws ChannelException
     */
    public function channelPost(): ChannelPost
    {
        if ($this->getMethod() !== UpdateMethodConstant::CHANNEL_POST) {
            throw new ChannelException('Channel post does not exist');
        }

        return new ChannelPost($this->updates[UpdateMethodConstant::CHANNEL_POST]);
    }

    /**
     * @return EditedChannelPost
     * @throws ChannelException
     */
    public function editedChannelPost(): EditedChannelPost
    {
        if ($this->getMethod() !== UpdateMethodConstant::EDITED_CHANNEL_POST) {
            throw new ChannelException('Edited channel post does not exist');
        }

        return new EditedChannelPost($this->updates[UpdateMethodConstant::EDITED_CHANNEL_POST]);
    }
}
