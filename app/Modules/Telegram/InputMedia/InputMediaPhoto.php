<?php


namespace App\Modules\Telegram\InputMedia;


class InputMediaPhoto
{

    /**
     * @var string
     */
    private $media;

    public function __invoke(string $media): array
    {
        return [
            'type' => 'photo',
            'media' => $media
        ];
    }

//    public function
}
