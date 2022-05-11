<?php


namespace App\Modules\Telegram;


use Illuminate\Support\Str;

class ReplyMarkup
{
    /**
     * @var bool $one_time_keyboard
     */
    private $one_time_keyboard = false;

    /**
     * @var bool $resize_keyboard
     */
    private $resize_keyboard = false;

    /**
     * @var bool $is_inline_keyboard
     */
    private $is_inline_keyboard = false;

    /**
     * @var bool $is_keyboard
     */
    private $is_keyboard = true;

    /**
     * @var bool $is_remove_keyboard
     */
    private $is_remove_keyboard = false;

    /**
     * @var boolean $is_force_reply
     */
    private $is_force_reply = false;

    /**
     * @var array $keyboard
     */
    private $keyboard = [];

    /**
     * @var string[] $keyboard_types
     */
    private $keyboard_types = [
        'inline_keyboard',
        'keyboard',
        'force_reply',
        'remove_keyboard'
    ];

    /**
     * @param array $keyboard
     * @return false|string
     */
    public function keyboard(array $keyboard = [])
    {
        return json_encode($this->getKeyboard($keyboard));
    }

    /**
     * @return $this
     */
    public function reply(): ReplyMarkup
    {
        $this->initKeyboardType('is_keyboard');

        return $this;
    }

    /**
     * @return $this
     */
    public function inline(): ReplyMarkup
    {
        $this->initKeyboardType('is_inline_keyboard');

        return $this;
    }

    /**
     * @return $this
     */
    public function removeKeyboard(): ReplyMarkup
    {
        $this->initKeyboardType('is_remove_keyboard');

        return $this;
    }

    /**
     * @return $this
     */
    public function forceKeyboard(): ReplyMarkup
    {
        $this->initKeyboardType('is_force_reply');

        return $this;
    }

    /**
     * @return $this
     */
    public function oneTimeKeyboard(): ReplyMarkup
    {
        $this->one_time_keyboard = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function resizeKeyboard(): ReplyMarkup
    {
        $this->resize_keyboard = true;

        return $this;
    }

    /**
     * @param array $keyboard
     * @return array|bool[]
     */
    private function getKeyboard(array $keyboard): array
    {
        $this->setKeyboardType($keyboard);

        return $this->keyboard;
    }

    /**
     * Set keyboard type (inline or not)
     * @param array $keyboard
     */
    private function setKeyboardType(array $keyboard)
    {
        if ($this->is_keyboard) {
            $this->keyboard['keyboard'] = $keyboard;
            $this->keyboard['one_time_keyboard'] = $this->one_time_keyboard;
            $this->keyboard['resize_keyboard'] = $this->resize_keyboard;
        }

        if ($this->is_inline_keyboard) {
            $this->keyboard['inline_keyboard'] = $keyboard;
        }

        if ($this->is_remove_keyboard) {
            $this->keyboard['remove_keyboard'] = true;
        }

        if ($this->is_force_reply) {
            $this->keyboard['force_reply'] = true;
        }
    }

    /**
     * @param string $keyboard
     * @return void
     */
    private function initKeyboardType(string $keyboard)
    {
        $keyboard = Str::replace('is_', '', $keyboard);

        foreach ($this->keyboard_types as $keyboard_type) {
            $this->$keyboard_type = $keyboard === $keyboard_type;
        }
    }

}
