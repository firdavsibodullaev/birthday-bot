<?php

namespace App\Modules\Telegram;

class CheckUpdateType
{

    const MESSAGE = 'message';

    const MY_CHAT_MEMBER = 'my_chat_member';

    const CALLBACK_QUERY = 'callback_query';

    /**
     * @param array $update
     * @return bool
     */
    public static function isMessage(array $update): bool
    {
        return isset($update[self::MESSAGE]);
    }

    /**
     * @param array $update
     * @return bool
     */
    public static function isChatMember(array $update): bool
    {
        return isset($update[self::MY_CHAT_MEMBER]);
    }

    /**
     * @param array $update
     * @return bool
     */
    public static function isCallbackQuery(array $update): bool
    {
        return isset($update[self::CALLBACK_QUERY]);
    }
}
