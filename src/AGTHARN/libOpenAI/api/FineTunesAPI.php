<?php

declare(strict_types=1);

namespace AGTHARN\libOpenAI\api;

use AGTHARN\libOpenAI\Helper;

/**
 * Manage fine-tuning jobs to tailor a model to your specific training data.
 * Related to https://beta.openai.com/docs/guides/fine-tuning.
 * 
 * NOTE: Fine-tuning is still a beta feature! Please use with caution!
 */
class FineTunesAPI
{
    public const API_V1 = 'https://api.openai.com/v1/fine-tunes';

    /**
     * Creates a job that fine-tunes a specified model from a given dataset. 
     * Response includes details of the enqueued job including job status and the name of the fine-tuned models once complete.
     * 
     * Learn more about fine-tuning: https://beta.openai.com/docs/guides/fine-tuning
     *
     * @param string $apiKey Your OpenAI API key
     * @param string $training_file The ID of an uploaded file that contains training data.
     * @param array $extraData Extra data for the request body
     * @param callable|null $callback Callback function to run when the request is complete
     * @param callable|null $callbackAsync Callback function to run when the request is complete (async)
     * @return int|array|null
     */
    public static function create(
        string $apiKey,
        string $training_file,
        array $extraData = [],
        ?callable $callback = null,
        ?callable $callbackAsync = null
    ): mixed {
        return Helper::sendRequest('POST', $apiKey, json_encode(array_merge([
            'training_file' => $training_file
        ], $extraData)), self::API_V1, $callback, $callbackAsync);
    }

    /**
     * List your organization's fine-tuning jobs
     *
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
     * Gets info about the fine-tune job.
     * 
     * Learn more about fine-tuning: https://beta.openai.com/docs/guides/fine-tuning.
     *
     * @param string $apiKey Your OpenAI API key
     * @param string $fine_tune_id The ID of the fine-tune job
     * @param callable|null $callback Callback function to run when the request is complete
     * @param callable|null $callbackAsync Callback function to run when the request is complete (async)
     * @return int|array|null
     */
    public static function retrieve(
        string $apiKey,
        string $fine_tune_id,
        ?callable $callback = null,
        ?callable $callbackAsync = null
    ): mixed {
        return Helper::sendRequest('GET', $apiKey, '', self::API_V1 . '/' . $fine_tune_id, $callback, $callbackAsync);
    }

    /**
     * Immediately cancel a fine-tune job.
     *
     * @param string $apiKey Your OpenAI API key
     * @param string $fine_tune_id The ID of the fine-tune job
     * @param callable|null $callback Callback function to run when the request is complete
     * @param callable|null $callbackAsync Callback function to run when the request is complete (async)
     * @return int|array|null
     */
    public static function cancel(
        string $apiKey,
        string $fine_tune_id,
        ?callable $callback = null,
        ?callable $callbackAsync = null
    ): mixed {
        return Helper::sendRequest('POST', $apiKey, '', self::API_V1 . '/' . $fine_tune_id . '/cancel', $callback, $callbackAsync);
    }

    /**
     * Get fine-grained status updates for a fine-tune job.
     * // TODO: Query parameters
     *
     * @param string $apiKey Your OpenAI API key
     * @param string $fine_tune_id The ID of the fine-tune job to get events for.
     * @param callable|null $callback Callback function to run when the request is complete
     * @param callable|null $callbackAsync Callback function to run when the request is complete (async)
     * @return int|array|null
     */
    public static function listEvents(
        string $apiKey,
        string $fine_tune_id,
        ?callable $callback = null,
        ?callable $callbackAsync = null
    ): mixed {
        return Helper::sendRequest('GET', $apiKey, '', self::API_V1. '/' . $fine_tune_id . '/events', $callback, $callbackAsync);
    }

    /**
     * Delete a fine-tuned model. You must have the Owner role in your organization.
     *
     * @param string $apiKey Your OpenAI API key
     * @param string $model The model to delete
     * @param callable|null $callback Callback function to run when the request is complete
     * @param callable|null $callbackAsync Callback function to run when the request is complete (async)
     * @return int|array|null
     */
    public static function deleteModel(
        string $apiKey,
        string $model,
        ?callable $callback = null,
        ?callable $callbackAsync = null
    ): mixed {
        return Helper::sendRequest('DELETE', $apiKey, '', ModelsAPI::API_V1 . '/' . $model, $callback, $callbackAsync);
    }
}
