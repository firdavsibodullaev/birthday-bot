<?php


namespace App\Modules\Telegram;


use App\Models\Message;
use Carbon\Carbon;

class MessageLog
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
     * @param string $message_type
     * @param string|null $comment
     * @param bool $is_bot
     */
    public function createLog(string $message_type = 'inline', ?string $comment = null, bool $is_bot = true)
    {
        $create_message = [];
        if (isset($this->message[0])) {
            foreach ($this->message as $key => $message) {
                $create_message[] = $this->prepareData($message);
            }
        } else {
            $create_message[] = $this->prepareData($this->message);
        }
        Message::query()->insert($create_message);
    }

    /**
     * @param array $message
     * @param string $message_type
     * @param string|null $comment
     * @param bool $is_bot
     * @return array
     */
    protected function prepareData(
        array   $message,
        string  $message_type = 'inline',
        ?string $comment = null,
        bool    $is_bot = true
    ): array
    {
        $date = Carbon::createFromTimestamp($message['result']['date']);

        return $create_message[] = [
            'message_id' => $message['result']['message_id'],
            'message' => $message['result']['text'] ?? $message['result']['caption'],
            'bot_user_id' => $message['result']['chat']['id'],
            'message_type' => $message_type,
            'comment' => $comment,
            'is_bot' => $is_bot,
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
