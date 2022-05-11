<?php


namespace App\Modules\Telegram;


use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Http;

class Telegram
{

    /**
     * @var Repository|Application|mixed|string
     */
    private $token;

    public $media_group_type;

    /**
     * @var string
     */
    private $base_url = "https://api.telegram.org/bot{token}/{method}";

    /**
     * Telegram constructor.
     * @param string|null $token
     */
    public function __construct(?string $token = null)
    {
        $this->token = $token ?: config('services.telegram.token');
        $this->base_url = str_replace('{token}', $this->token, $this->base_url);
    }

    /**
     * Sets webhook
     * @param string $url
     * @return array|mixed
     */
    public function setWebhook(string $url)
    {
        return $this->send('setWebhook', [
            'url' => $url
        ]);
    }

    /**
     * @return WebhookUpdates
     */
    public function getWebhookUpdates(): WebhookUpdates
    {
        $content = file_get_contents('php://input');
        return new WebhookUpdates(json_decode($content, true));
    }

    /**
     * @param array $params
     * @return GetUpdates
     */
    public function getUpdates(array $params = []): GetUpdates
    {
        $base_url = $this->setMethod('getUpdates');
        $request = Http::get($base_url, $params);

        return new GetUpdates($request->json());
    }

    /**
     * @param string $method
     * @param array $params
     * @param array $file
     * @return mixed
     */
    public function send(string $method, array $params, array $file = [])
    {
        $http = app(Http::class);

        $base_url = $this->setMethod($method);

        if (!empty($file)) {
            $http = $http::attach($file['type'], $file['content'], $file['name']);
        }

        $request = empty($file)
            ? $http::post($base_url, array_filter($params))
            : $http->post($base_url, array_filter($params));

        if (!$request->successful()) {
            $this->sendErrorMessage($params, $request->json());
        }

        return $request->json();
    }

    /**
     * @param array $params
     * @param array $files
     * @return void
     */
    public function sendMediaGroup(array $params, array $files = [])
    {
        $base_url = $this->setMethod('sendMediaGroup');
        $request = Http::withHeaders([]);
        if (!empty($files)) {
            foreach ($files as $file) {
                $request->attach($file['type'], $file['content'], $file['name']);
            }
        }
        $response = $request->post($base_url, $params);

        dd($response->json());

//        if ($request->successful()) {
//            return $request->json();
//        } else {
//            $this->sendErrorMessage($params, $request->json());
//        }
    }

    /**
     * @param string $method
     * @return string
     */
    private function setMethod(string $method): string
    {
        return str_replace('{method}', $method, $this->base_url);
    }

    /**
     * @param array $params
     * @param array $request
     */
    private function sendErrorMessage(array $params, array $request)
    {
        try {
            $this->send('sendMessage', [
                'chat_id' => 287956415,
                'text' => json_encode([
                    'params' => $params,
                    'error' => $request
                ])
            ]);
        } catch (\Exception $exception) {
            info($exception);
        }

    }

    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $file_id
     * @return File\File
     */
    public function getFile(string $file_id): File\File
    {
        $file = $this->send('getFile', [
            'file_id' => $file_id
        ]);

        return new File\File($file['result']);
    }

    /**
     * @param string $path
     * @return string
     */
    public function getFilePathUrl(string $path): string
    {
        return "https://api.telegram.org/file/bot{$this->token}/{$path}";
    }

    /**
     * @param string $path
     * @return string
     */
    public function getFileFromPath(string $path): string
    {
        $request = Http::get("https://api.telegram.org/file/bot{$this->token}/{$path}");
        return $request->body();
    }

    public function __destruct()
    {
    }
}
