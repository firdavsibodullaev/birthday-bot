<?php

namespace App\Modules\Telegram;

class GetUpdates
{
    /**
     * @var array
     */
    private $result;
    /**
     * @var boolean
     */
    public $ok;
    /**
     * @var array
     */
    public $results;

    public function __construct(array $updates)
    {
        $this->result = $updates['result'];

        $this->ok = $updates['ok'];

        $this->results = $this->setUpdates();
    }

    /**
     * @return array
     */
    protected function setUpdates(): array
    {
        $updates = [];

        for ($i = 0; $i < count($this->result); $i++) {
            $updates[] = new WebhookUpdates($this->result[$i]);
        }

        return $updates;
    }
}
