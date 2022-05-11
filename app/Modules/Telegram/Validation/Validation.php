<?php


namespace App\Modules\Telegram\Validation;


class Validation
{

    /**
     * @var string
     */
    private $text;

    /**
     * @var bool
     */
    private $is_failed = false;

    /**
     * @var array
     */
    private $error_details = [];

    /**
     * Validation constructor.
     * @param string|null $text
     */
    public function __construct(?string $text = null)
    {
        $this->text = $text;
    }

    /**
     * @param string $attribute
     * @return Validation
     */
    public function attributes(string $attribute): Validation
    {
        $this->text = $attribute;

        return $this;
    }

    /**
     * @param string $rule
     * @param ...$rules
     * @return Validation
     */
    public function check(string $rule, ...$rules): Validation
    {
        $check_rule = explode(':', $rule);
        $method = $check_rule[0];
        $this->$method(($check_rule[1] ?? ''));

        foreach ($rules as $rule) {
            $check_rule = explode(':', $rule);
            $method = $check_rule[0];
            $this->$method(($check_rule[1] ?? ''));
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function fails(): bool
    {
        return $this->is_failed;
    }

    /**
     * @return array
     */
    public function details(): array
    {
        return $this->error_details;
    }


    /**
     * @param string $check
     * @return Validation
     */
    private function in(string $check = ''): Validation
    {
        $check_list = is_null($check) ? [] : explode(",", $check);

        if (!in_array($this->text, $check_list) || empty($check_list)) {
            $this->is_failed = true;
            array_push($this->error_details, __('Boshqa ma\'lumot kiriting'));
        }
        return $this;
    }

    /**
     * @return $this
     */
    private function name(): Validation
    {
        if (preg_match("/[^A-ZА-ЯЁҒҚЎҲa-zа-яёўҳғқ'\s]/u", $this->text)) {
            $this->is_failed = true;
            array_push($this->error_details, __('Ism(familiya)ngizni to\'g\'ri kiriting'));
        }

        return $this;
    }

    /**
     * @param string $check
     * @return Validation
     */
    private function regex(string $check = ''): Validation
    {
        if (is_null($check) || !preg_match($check, $this->text)) {
            $this->is_failed = true;
            array_push($this->error_details, __('To\'g\'ri namuna asosida kiriting'));
        }

        return $this;
    }

    /**
     * @param string $check
     * @return Validation
     */
    private function isContact(string $check = ''): Validation
    {
        if (!boolval($check)) {
            $this->is_failed = true;
            array_push($this->error_details, __('Iltimos, "Raqamni ulashish" tugmasini bosing'));
        }

        return $this;
    }

    /**
     * @param string $check
     * @return Validation
     */
    private function amount(string $check = ''): Validation
    {
        if (!(double)$this->text) {
            $this->is_failed = true;
            array_push($this->error_details, __('Iltimos, To\'g\'ri miqdor kiriting'));
        }

        return $this;
    }

    /**
     * @param string $check
     * @return Validation
     */
    private function max(string $check = ''): Validation
    {
        if (mb_strlen($this->text) > $check) {
            $this->is_failed = true;
            // ToDo add amount to the text
            array_push($this->error_details, __('Juda uzun matn kiritdingiz, iltimos kamroq kiriting'));
        }
        return $this;
    }
}
