<?php

declare(strict_types=1);

namespace AGTHARN\libOpenAI\api;

use AGTHARN\libOpenAI\Helper;

/**
 * List and describe the various models available in the API.
 * You can refer to the Models documentation to understand what models are available and the differences between them.
 * https://beta.openai.com/docs/models
 */
class ModelsAPI
{
    public const API_V1 = 'https://api.openai.com/v1/models';

    /**
     * Lists the currently available models, and provides basic information about each one such as the owner and availability.
     *
     * @param string $apiKey Your OpenAI API key
     * @param callable|null $callback Callback function to run when the request is complete
     * @return int|array|null
     */
    public static function list(
        string $apiKey,
        ?callable $callback = null
    ): mixed {
        return Helper::sendRequest('GET', $apiKey, '', self::API_V1, $callback);
    }

    /**
     * Retrieves a model instance, providing basic information about the model such as the owner and permissioning.
     * ( wow i cant believe github copilot did this for me, such irony )
     *
     * @param string $apiKey Your OpenAI API key
     * @param string $model The ID of the model to use for this request
     * @param callable|null $callback Callback function to run when the request is complete
     * @return int|array|null
     */
    public static function retrieve(
        string $apiKey,
        string $model,
        ?callable $callback = null
    ): mixed {
        return Helper::sendRequest('GET', $apiKey, '', self::API_V1 . '/' . $model, $callback);
    }

    /**
     * Delete a fine-tuned model. You must have the Owner role in your organization.
     *
     * @deprecated This is part of Fine-tunes in documentation. I don't know why it's not part of models instead.
     * @see \AGTHARN\libOpenAI\api\FineTunesAPI::delete()
     * 
     * @param string $apiKey Your OpenAI API key
     * @param string $model The model to delete
     * @param callable|null $callback Callback function to run when the request is complete
     * @return int|array|null
     */
    public static function delete(
        string $apiKey,
        string $model,
        ?callable $callback = null
    ): mixed {
        return Helper::sendRequest('DELETE', $apiKey, '', ModelsAPI::API_V1 . '/' . $model, $callback);
    }
}
