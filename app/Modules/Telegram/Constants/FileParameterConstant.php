<?php

namespace App\Modules\Telegram\Constants;

class FileParameterConstant
{

    /** @var string[] */
    const VIDEO = [
        'method' => 'sendVideo',
        'type' => 'video'
    ];

    /** @var string[] */
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

    const VOICE = [
        'method' => 'sendVoice',
        'type' => 'voice'
    ];

    const VOICE_NOTE = [
        'method' => 'sendVoiceNote',
        'type' => 'voice_note'
    ];


    /**
     * @return \string[][]
     */
    public static function list(): array
    {
        return [
            'audio' => self::AUDIO,
            'application' => self::DOCUMENT,
            'image' => self::PHOTO,
            'video' => self::VIDEO,
            'voice' => self::VOICE,
            'voice_note' => self::VOICE_NOTE,
        ];
    }
}
