<?php

declare(strict_types=1);

namespace AGTHARN\libOpenAI\api\type;

use AGTHARN\libOpenAI\api\API;
use AGTHARN\libOpenAI\Helper;

/**
 * Given a input text, outputs if the model classifies it as violating OpenAI's content policy.
 * Related to https://beta.openai.com/docs/guides/moderation.
 */
class Moderations extends API
{
    public const API_V1 = 'https://api.openai.com/v1/moderations';

    /**
     * Classifies if text violates OpenAI's Content Policy
     *
     * @param string|array $input The input text to classify
     * @param array $extraData Extra data for the request body
     * @param callable|null $callback Callback function to run when the request is complete
     * @param callable|null $callbackAsync Callback function to run when the request is complete (async)
     * @return int|array|null
     */
    public function create(
        string|array $input,
        array $extraData = [], // nothing extra but this is incase of api changes
        ?callable $callback = null,
        ?callable $callbackAsync = null
    ): mixed {
        return Helper::sendRequest('POST', $this->apiKey, self::API_V1, json_encode(array_merge([
            'input' => $input
        ], $extraData)), $callback, $callbackAsync);
    }
}
