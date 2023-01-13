<?php

declare(strict_types=1);

namespace AGTHARN\libOpenAI\api;

use AGTHARN\libOpenAI\Helper;

/**
 * Get a vector representation of a given input that can be easily consumed by machine learning models and algorithms.
 * Related to https://beta.openai.com/docs/guides/embeddings.
 */
class EmbeddingsAPI
{
    public const API_V1 = 'https://api.openai.com/v1/embeddings';

    /**
     * Creates an embedding vector representing the input text.
     *
     * @param string $apiKey Your OpenAI API key
     * @param string $input Input text to get embeddings for, encoded as a string or array of tokens. To get embeddings for multiple inputs in a single request, pass an array of strings or array of token arrays. Each input must not exceed 8192 tokens in length.
     * @param string $model ID of the model to use. You can use the List models API to see all of your available models, or see OpenAI's Model overview for descriptions of them.
     * @param array $extraData Extra data for the request body
     * @param callable|null $callback Callback function to run when the request is complete
     * @param callable|null $callbackAsync Callback function to run when the request is complete (async)
     * @return int|array|null
     */
    public static function create(
        string $apiKey,
        string $input,
        string $model,
        array $extraData = [],
        ?callable $callback = null,
        ?callable $callbackAsync = null
    ): mixed {
        return Helper::sendRequest('POST', $apiKey, json_encode(array_merge([
            'model' => $model,
            'input' => $input
        ], $extraData)), self::API_V1, $callback, $callbackAsync);
    }
}
