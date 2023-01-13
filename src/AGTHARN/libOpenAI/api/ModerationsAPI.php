<?php

declare(strict_types=1);

namespace AGTHARN\libOpenAI\api;

use AGTHARN\libOpenAI\Helper;

/**
 * Given a input text, outputs if the model classifies it as violating OpenAI's content policy.
 * Related to https://beta.openai.com/docs/guides/moderation.
 */
class ModerationsAPI
{
    public const API_V1 = 'https://api.openai.com/v1/moderations';

    /**
     * Classifies if text violates OpenAI's Content Policy
     *
     * @param string $apiKey Your OpenAI API key
     * @param string $input The input text to classify
     * @param array $extraData Extra data for the request body
     * @param callable|null $callback Callback function to run when the request is complete
     * @param callable|null $callbackAsync Callback function to run when the request is complete (async)
     * @return int|array|null
     */
    public static function create(
        string $apiKey,
        string $input,
        array $extraData = [], // nothing extra but this is incase of api changes
        ?callable $callback = null,
        ?callable $callbackAsync = null
    ): mixed {
        return Helper::sendRequest('POST', $apiKey, json_encode(array_merge([
            'input' => $input
        ], $extraData)), self::API_V1, $callback, $callbackAsync);
    }
}
