<?php

declare(strict_types=1);

namespace AGTHARN\libOpenAI\api\type;

use AGTHARN\libOpenAI\Helper;
use AGTHARN\libOpenAI\api\API;

/**
 * Given a prompt and an instruction, the model will return an edited version of the prompt.
 */
class Edits extends API
{
    public const API_V1 = 'https://api.openai.com/v1/edits';

    /**
     * Creates a new edit for the provided input, instruction, and parameters
     * 
     * @param string $input The input text to use as a starting point for the edit.
     * @param string $instruction The instruction that tells the model how to edit the prompt.
     * @param string $model ID of the model to use. You can use the List models API to see all of your available models, or see OpenAI's Model overview for descriptions of them.
     * @param array $extraData Extra data for the request body
     * @param callable|null $callback Callback function to run when the request is complete
     * @param callable|null $callbackAsync Callback function to run when the request is complete (async)
     * @return int|array|null
     */
    public function create(
        string $input,
        string $instruction,
        string $model = 'text-davinci-edit-001',
        array $extraData = [],
        ?callable $callback = null,
        ?callable $callbackAsync = null
    ): mixed {
        return Helper::sendRequest('POST', $this->apiKey, self::API_V1, json_encode(array_merge([
            'model' => $model,
            'input' => $input,
            'instruction' => $instruction
        ], $extraData)), $callback, $callbackAsync);
    }
}
