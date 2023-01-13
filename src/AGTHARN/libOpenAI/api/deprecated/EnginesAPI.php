<?php

declare(strict_types=1);

namespace AGTHARN\libOpenAI\api\deprecated;

use AGTHARN\libOpenAI\Helper;

/**
 * NOTE:
 * The Engines endpoints are DEPRECATED. Please use their replacement, Models, instead.
 * https://beta.openai.com/docs/api-reference/models
 * 
 * These endpoints describe and provide access to the various engines available in the API.
 */
class EnginesAPI
{
    public const API_V1 = 'https://api.openai.com/v1/engines';

    /**
     * Lists the currently available (non-fine-tuned) models,
     * and provides basic information about each one such as the owner and availability.
     *
     * @deprecated The Engines endpoints are DEPRECATED.
     * @param string $apiKey Your OpenAI API key
     * @param callable|null $callback Callback function to run when the request is complete
     * @param callable|null $callbackAsync Callback function to run when the request is complete (async)
     * @return int|array|null
     */
    public static function list(
        string $apiKey,
        ?callable $callback = null,
        ?callable $callbackAsync = null
    ): mixed {
        return Helper::sendRequest('GET', $apiKey, '', self::API_V1, $callback, $callbackAsync);
    }

    /**
     * Retrieves a model instance, providing basic information about it such as the owner and availability.
     *
     * @deprecated The Engines endpoints are DEPRECATED.
     * @param string $apiKey Your OpenAI API key
     * @param string $engine_id The ID of the engine to use for this request
     * @param callable|null $callback Callback function to run when the request is complete
     * @param callable|null $callbackAsync Callback function to run when the request is complete (async)
     * @return int|array|null
     */
    public static function retrieve(
        string $apiKey,
        string $engine_id,
        ?callable $callback = null,
        ?callable $callbackAsync = null
    ): mixed {
        return Helper::sendRequest('GET', $apiKey, '', self::API_V1 . '/' . $engine_id, $callback, $callbackAsync);
    }
}
