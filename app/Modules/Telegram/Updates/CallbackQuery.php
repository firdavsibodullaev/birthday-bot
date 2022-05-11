<?php


namespace App\Modules\Telegram\Updates;


class CallbackQuery
{
    /**
     * @var array
     */
    private $callback_query;

    public function __construct(array $callback_query)
    {
        $this->callback_query = $callback_query;
    }

    /**
     * @return Message
     */
    public function message(): Message
    {
        return new Message($this->callback_query['message']);
    }

    /**
     * @return mixed
     */
    public function from()
    {
        return new From($this->callback_query['from']);
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->callback_query['data'];
    }

    /**
     * @return false|string
     */
    public function body()
    {
        return json_encode($this->callback_query);
    }

    /**
     * @return array
     */
    public function json(): array
    {
        return $this->callback_query;
    }

    /**
     * @return string
     */
    public function getChatInstance(): string
    {
        return $this->callback_query['chat_instance'];
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->callback_query['id'];
    }

    /**
     * @return string
     */
    public function getInlineMessageId(): string
    {
        return $this->callback_query['inline_message_id'];
    }
}
