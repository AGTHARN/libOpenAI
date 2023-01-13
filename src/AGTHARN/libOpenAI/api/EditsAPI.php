<?php

declare(strict_types=1);

namespace AGTHARN\libOpenAI\api;

use AGTHARN\libOpenAI\Helper;

/**
 * Given a prompt and an instruction, the model will return an edited version of the prompt.
 */
class EditsAPI
{
    public const API_V1 = 'https://api.openai.com/v1/edits';

    /**
     * Creates a new edit for the provided input, instruction, and parameters
     *
     * @param string $apiKey Your OpenAI API key
     * @param string $input The input text to use as a starting point for the edit.
     * @param string $instruction The instruction that tells the model how to edit the prompt.
     * @param string $model ID of the model to use. You can use the List models API to see all of your available models, or see OpenAI's Model overview for descriptions of them.
     * @param array $extraData Extra data for the request body
     * @param callable|null $callback Callback function to run when the request is complete
     * @return int|array|null
     */
    public static function create(
        string $apiKey,
        string $input,
        string $instruction,
        string $model = 'text-davinci-edit-001',
        array $extraData = [],
        ?callable $callback = null
    ): mixed {
        return Helper::sendRequest('POST', $apiKey, json_encode(array_merge([
            'model' => $model,
            'input' => $input,
            'instruction' => $instruction
        ], $extraData)), self::API_V1, $callback);
    }
}
