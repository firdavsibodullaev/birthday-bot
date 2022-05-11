<?php


namespace App\Modules\Telegram\Updates;


class Contact
{
    /**
     * @var array
     */
    private $contact;

    public function __construct(array $contact)
    {
        $this->contact = $contact;
    }

    /**
     * @return string
     */
    public function phoneNumber(): string
    {
        return $this->contact['phone_number'];
    }

    /**
     * @return mixed
     */
    public function firstName()
    {
        return $this->contact['first_name'];
    }

    /**
     * @return mixed
     */
    public function userId()
    {
        return $this->contact['user_id'];
    }
}
