<?php


namespace App\Modules\Telegram\Updates;


class File
{
    /**
     * @var string[]
     */
    private $file_types = [
        'audio',
        'document',
        'photo',
        'video',
        'sticker',
        'voice',
        'animation',
    ];

    /**
     * @var array
     */
    private $message;

    public function __construct(array $message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        foreach ($this->file_types as $file_type) {
            if (isset($this->message[$file_type])) {
                return $file_type;
            }
        }
        return "";
    }

    /**
     * @return string
     */
    public function fileId(): string
    {
        if ($this->getType() === 'photo') {
            return end($this->message['photo'])['file_id'];
        }

        return $this->message[$this->getType()]['file_id'];
    }

    /**
     * @return int|null
     */
    public function size(): ?int
    {
        if ($this->getType() === 'photo') {
            return end($this->message['photo'])['file_size'] ?? null;
        }

        return $this->message[$this->getType()]['file_size'] ?? null;
    }
}
