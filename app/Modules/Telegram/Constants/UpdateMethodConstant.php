<?php

namespace App\Modules\Telegram\Constants;

class UpdateMethodConstant
{

    const MESSAGE = 'message';

    const MY_CHAT_MEMBER = 'my_chat_member';

    const CALLBACK_QUERY = 'callback_query';

    const CHAT_MEMBER = 'chat_member';

    const EDITED_MESSAGE = 'edited_message';

    const CHANNEL_POST = 'channel_post';

    const EDITED_CHANNEL_POST = 'edited_channel_post';

    const INLINE_QUERY = 'inline_query';

    const CHOSEN_INLINE_RESULT = 'chosen_inline_result';

    const SHIPPING_QUERY = 'shipping_query';

    const PRE_CHECKOUT_QUERY = 'pre_checkout_query';

    const POLL = 'poll';

    const POLL_ANSWER = 'poll_answer';

    const CHAT_JOIN_REQUEST = 'chat_join_request';

    /**
     * @return string[]
     */
    public static function list(): array
    {
        return [
            self::CALLBACK_QUERY,
            self::MY_CHAT_MEMBER,
            self::MESSAGE,
            self::CHANNEL_POST,
            self::CHAT_JOIN_REQUEST,
            self::CHAT_MEMBER,
            self::CHOSEN_INLINE_RESULT,
            self::EDITED_CHANNEL_POST,
            self::EDITED_MESSAGE,
            self::INLINE_QUERY,
            self::POLL,
            self::POLL_ANSWER,
            self::PRE_CHECKOUT_QUERY,
            self::SHIPPING_QUERY,
        ];
    }
}
