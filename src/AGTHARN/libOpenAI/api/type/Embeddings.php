<?php

declare(strict_types=1);

namespace AGTHARN\libOpenAI\api\type;

use AGTHARN\libOpenAI\Helper;
use AGTHARN\libOpenAI\api\API;

/**
 * Get a vector representation of a given input that can be easily consumed by machine learning models and algorithms.
 * Related to https://beta.openai.com/docs/guides/embeddings.
 */
class Embeddings extends API
{
    public const API_V1 = 'https://api.openai.com/v1/embeddings';

    /**
     * Creates an embedding vector representing the input text.
     * 
     * @param string $input Input text to get embeddings for, encoded as a string or array of tokens. To get embeddings for multiple inputs in a single request, pass an array of strings or array of token arrays. Each input must not exceed 8192 tokens in length.
     * @param string $model ID of the model to use. You can use the List models API to see all of your available models, or see OpenAI's Model overview for descriptions of them.
     * @param array $extraData Extra data for the request body
     * @param callable|null $callback Callback function to run when the request is complete
     * @param callable|null $callbackAsync Callback function to run when the request is complete (async)
     * @return int|array|null
     */
    public function create(
        string $input,
        string $model,
        array $extraData = [],
        ?callable $callback = null,
        ?callable $callbackAsync = null
    ): mixed {
        return Helper::sendRequest('POST', $this->apiKey, self::API_V1, json_encode(array_merge([
            'model' => $model,
            'input' => $input
        ], $extraData)), $callback, $callbackAsync);
    }
}
