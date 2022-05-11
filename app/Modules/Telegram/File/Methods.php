<?php


namespace App\Modules\Telegram\File;


class Methods
{

    const VIDEO = [
        'method' => 'sendVideo',
        'type' => 'video'
    ];

    const PHOTO = [
        'method' => 'sendPhoto',
        'type' => 'photo'
    ];

    const AUDIO = [
        'method' => 'sendAudio',
        'type' => 'audio'
    ];

    const DOCUMENT = [
        'method' => 'sendDocument',
        'type' => 'document'
    ];

    /**
     * @param string $method
     * @return string[]
     */
    public static function list(string $method): array
    {
        $list = [
            'image' => self::PHOTO,
            'video' => self::VIDEO,
            'audio' => self::AUDIO,
            'document' => self::DOCUMENT,
        ];
        return array_key_exists($method, $list) ? $list[$method] : self::DOCUMENT;
    }
}
