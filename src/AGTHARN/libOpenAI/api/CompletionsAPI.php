<?php

declare(strict_types=1);

namespace AGTHARN\libOpenAI\api;

use AGTHARN\libOpenAI\Helper;

/**
 * Given a prompt, the model will return one or more predicted completions,
 * and can also return the probabilities of alternative tokens at each position.
 */
class CompletionsAPI
{
    public const API_V1 = 'https://api.openai.com/v1/completions';

    /**
     * Creates a completion for the provided prompt and parameters
     *
     * @param string $apiKey Your OpenAI API key
     * @param string|array $prompt The prompt(s) to generate completions for, encoded as a string, array of strings, array of tokens, or array of token arrays.
     * @param string $model ID of the model to use. You can use the List models API to see all of your available models, or see OpenAI's Model overview for descriptions of them.
     * @param array $extraData Extra data for the request body
     * @param callable|null $callback Callback function to run when the request is complete
     * @param callable|null $callbackAsync Callback function to run when the request is complete (async)
     * @return int|array|null
     */
    public static function create(
        string $apiKey,
        string|array $prompt,
        string $model = 'text-davinci-003', // similar to ChatGPT (but not entirely)
        array $extraData = [],
        ?callable $callback = null,
        ?callable $callbackAsync = null
    ): mixed {
        return Helper::sendRequest('POST', $apiKey, json_encode(array_merge([
            'model' => $model,
            'prompt' => $prompt
        ], $extraData)), self::API_V1, $callback, $callbackAsync);
    }
}
