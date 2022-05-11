<?php


namespace App\Modules\Telegram\Constants;


class BotUserStatusConstant
{
    const MEMBER = 'member';

    const ADMINISTRATOR = 'administrator';

    const CREATOR = 'creator';

    const RESTRICTED = 'restricted';

    const LEFT = 'left';

    const BANNED = 'banned';

    /**
     * @return string[]
     */
    public static function list(): array
    {
        return [
            self::CREATOR,
            self::ADMINISTRATOR,
            self::MEMBER,
            self::RESTRICTED,
            self::LEFT,
            self::BANNED,
        ];
    }

    /**
     * @param string $member_status
     * @return bool
     */
    public static function isActiveStatus(string $member_status): bool
    {
        return in_array($member_status, [
            self::CREATOR,
            self::ADMINISTRATOR,
            self::MEMBER
        ]);
    }
}
