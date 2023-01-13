<?php

declare(strict_types=1);

namespace AGTHARN\libOpenAI;

use Closure;
use pocketmine\Server;
use pocketmine\utils\Internet;
use pocketmine\scheduler\AsyncTask;
use AGTHARN\libOpenAI\api\CompletionsAPI;

class Helper
{
    /**
     * Sends a request and returns a response.
     * If the callback parameter is not null, it will run asynchronously.
     *
     * @param string $requestType The request type, e.g. POST, GET, etc.
     * @param string $apiKey Your OpenAI API key
     * @param string $data The data to send to the API
     * @param string $apiURL OpenAI API URL
     * @param callable|null $callback Callback function to run when the request is complete
     * @param int $timeout The timeout in seconds
     * @return int|array|null
     */
    public static function sendRequest(
        string $requestType,
        string $apiKey,
        string $data = '',
        string $apiURL = CompletionsAPI::API_V1,
        ?callable $callback = null,
        int $timeout = 10
    ): mixed {
        return $callback === null ? self::sendNormalRequest($requestType, $apiKey, $data, $apiURL, $timeout) : self::sendAsyncRequest($callback, $requestType, $apiKey, $data, $apiURL, $timeout);
    }

    /**
     * Sends a request and returns a response (synchronously).
     * 
     * It is highly recommended to run this asynchronously instead!
     * @see \AGTHARN\libOpenAI\Helper::sendAsyncRequest()
     *
     * @param string $requestType The request type, e.g. POST, GET, etc.
     * @param string $apiKey Your OpenAI API key
     * @param string $data The data to send to the API
     * @param string $apiURL OpenAI API URL
     * @param int $timeout The timeout in seconds
     * @param bool $isResultArray Whether the result should be an array or an object
     * @return int|array|null
     */
    public static function sendNormalRequest(
        string $requestType,
        string $apiKey,
        string $data = '',
        string $apiURL = CompletionsAPI::API_V1,
        int $timeout = 10,
        bool $isResultArray = true // false for object result
    ): mixed {
        return json_decode(Internet::simpleCurl($apiURL, $timeout, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $apiKey,
        ], [
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_CUSTOMREQUEST => $requestType
        ])->getBody(), $isResultArray);
    }

    /**
     * Sends a request and returns a response (asynchronously).
     *
     * @param callable $callback The callback to run when the request is completed
     * @param string $requestType The request type, e.g. POST, GET, etc.
     * @param string $apiKey Your OpenAI API key
     * @param string $data The data to send to the API
     * @param string $apiURL OpenAI API URL
     * @param int $timeout The timeout in seconds
     * @param bool $isResultArray Whether the result should be an array or an object
     * @return int The worker ID
     */
    public static function sendAsyncRequest(
        callable $callback,
        string $requestType,
        string $apiKey,
        string $data = '',
        string $apiURL = CompletionsAPI::API_V1,
        int $timeout = 10,
        bool $isResultArray = true // false for object result
    ): int {
        return Server::getInstance()->getAsyncPool()->submitTask(new class($callback, $requestType, $apiKey, $data, $apiURL, $timeout, $isResultArray) extends AsyncTask
        {
            public function __construct(
                private Closure $callback,
                private string $requestType,
                private string $apiKey,
                private string $data,
                private string $apiURL,
                private int $timeout,
                private bool $isResultArray
            ) {
            }

            public function onRun(): void
            {
                $decoded = json_decode(Internet::simpleCurl($this->apiURL, $this->timeout, [
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $this->apiKey,
                ], [
                    CURLOPT_POST => 1,
                    CURLOPT_POSTFIELDS => $this->data,
                    CURLOPT_CUSTOMREQUEST => $this->requestType
                ])->getBody(), $this->isResultArray);

                $this->setResult($decoded);
            }

            public function onCompletion(): void
            {
                $result = $this->getResult();
                if (isset($result['error'])) {
                    throw new \Exception($result['error']['message']);
                }

                $callback = $this->callback;
                $callback($result);
            }
        });
    }
}
