<?php


namespace App\Modules\Telegram\File;

/**
 * Class File
 * @package App\Modules\Telegram\File
 */
class File
{

    /**
     * @var array
     */
    private $file;

    /**
     * File constructor.
     * @param array $file
     */
    public function __construct(array $file)
    {
        $this->file = $file;
    }

    /**
     * @return int
     */
    public function size(): int
    {
        return $this->file['file_size'];
    }

    /**
     * @return string
     */
    public function path(): string
    {
        return $this->file['file_path'];
    }

    /**
     * @return string
     */
    public function fileId(): string
    {
        return $this->file['file_id'];
    }

    /**
     * @return string
     */
    public function uniqueId(): string
    {
        return $this->file['file_unique_id'];
    }

}
