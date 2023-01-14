<?php

declare(strict_types=1);

namespace AGTHARN\libOpenAI\api\type;

use AGTHARN\libOpenAI\Helper;
use AGTHARN\libOpenAI\api\API;

/**
 * Files are used to upload documents that can be used with features like Fine-tuning.
 * https://beta.openai.com/docs/api-reference/fine-tunes
 */
class Files extends API
{
    public const API_V1 = 'https://api.openai.com/v1/files';

    /**
     * Returns a list of files that belong to the user's organization.
     *
     * @param callable|null $callback Callback function to run when the request is complete
     * @param callable|null $callbackAsync Callback function to run when the request is complete (async)
     * @return int|array|null
     */
    public function list(
        ?callable $callback = null,
        ?callable $callbackAsync = null
    ): mixed {
        return Helper::sendRequest('GET', $this->apiKey, self::API_V1, '', $callback, $callbackAsync);
    }

    /**
     * Upload a file that contains document(s) to be used across various endpoints/features.
     * Currently, the size of all the files uploaded by one organization can be up to 1 GB.
     * Please contact OpenAI if you need to increase the storage limit.
     *
     * @param string $file Name of the JSON Lines file to be uploaded.
     * @param string $purpose The intended purpose of the uploaded documents.
     * @param array $extraData Extra data for the request body
     * @param callable|null $callback Callback function to run when the request is complete
     * @param callable|null $callbackAsync Callback function to run when the request is complete (async)
     * @return int|array|null
     */
    public function upload(
        string $file,
        string $purpose,
        array $extraData = [], // nothing extra but this is incase of api changes
        ?callable $callback = null,
        ?callable $callbackAsync = null
    ): mixed {
        return Helper::sendRequest('POST', $this->apiKey, self::API_V1, json_encode(array_merge([
            'file' => $file,
            'purpose' => $purpose
        ], $extraData)), $callback, $callbackAsync);
    }

    /**
     * Delete a file.
     *
     * @param string $fileId
     * @param callable|null $callback Callback function to run when the request is complete
     * @param callable|null $callbackAsync Callback function to run when the request is complete (async)
     * @return int|array|null
     */
    public function delete(
        string $fileId,
        ?callable $callback = null,
        ?callable $callbackAsync = null
    ): mixed {
        return Helper::sendRequest('DELETE', $this->apiKey, self::API_V1 . '/' . $fileId, '', $callback, $callbackAsync);
    }

    /**
     * Returns information about a specific file.
     *
     * @param string $fileId The ID of the file to use for this request
     * @param callable|null $callback Callback function to run when the request is complete
     * @param callable|null $callbackAsync Callback function to run when the request is complete (async)
     * @return int|array|null
     */
    public function retrieve(
        string $fileId,
        ?callable $callback = null,
        ?callable $callbackAsync = null
    ): mixed {
        return Helper::sendRequest('GET', $this->apiKey, self::API_V1 . '/' . $fileId, '', $callback, $callbackAsync);
    }

    /**
     * Returns the contents of the specified file
     * 
     * @param string $fileId The ID of the file to use for this request
     * @param callable|null $callback Callback function to run when the request is complete
     * @param callable|null $callbackAsync Callback function to run when the request is complete (async)
     * @return int|array|null
     */
    public function retrieveContent(
        string $fileId,
        ?callable $callback = null,
        ?callable $callbackAsync = null
    ): mixed {
        return Helper::sendRequest('GET', $this->apiKey, self::API_V1 . '/' . $fileId . '/content', '', $callback, $callbackAsync);
    }
}
