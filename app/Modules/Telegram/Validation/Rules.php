<?php


namespace App\Modules\Telegram\Validation;


class Rules
{

    /**
     * @param string $text
     * @param array $parameters
     * @return bool
     */
    static function in(string $text, array $parameters): bool
    {
        return in_array($text, $parameters);
    }
}
