<?php

declare(strict_types=1);

namespace AGTHARN\libOpenAI\api;

use AGTHARN\libOpenAI\Helper;

/**
 * Given a prompt and/or an input image, the model will generate a new image.
 * Related to https://beta.openai.com/docs/guides/images.
 */
class ImagesAPI
{
    public const API_V1_GENERATIONS = 'https://api.openai.com/v1/images/generations';
    public const API_V1_EDITS = 'https://api.openai.com/v1/images/edits';
    public const API_V1_VARIATIONS = 'https://api.openai.com/v1/images/variations';

    /**
     * Creates an image given a prompt.
     * Related to https://beta.openai.com/docs/guides/images.
     *
     * @param string $apiKey Your OpenAI API key
     * @param string $prompt A text description of the desired image(s). The maximum length is 1000 characters.
     * @param array $extraData Extra data for the request body
     * @param callable|null $callback Callback function to run when the request is complete
     * @return int|array|null
     */
    public static function create(
        string $apiKey,
        string $prompt,
        array $extraData = [],
        ?callable $callback = null
    ): mixed {
        return Helper::sendRequest('POST', $apiKey, json_encode(array_merge([
            'prompt' => $prompt
        ], $extraData)), self::API_V1_GENERATIONS, $callback);
    }

    /**
     * Creates an edited or extended image given an original image and a prompt.
     *
     * @param string $apiKey Your OpenAI API key
     * @param string $image The image to edit. Must be a valid PNG file, less than 4MB, and square. If mask is not provided, image must have transparency, which will be used as the mask.
     * @param string $prompt A text description of the desired image(s). The maximum length is 1000 characters.
     * @param array $extraData Extra data for the request body
     * @param callable|null $callback Callback function to run when the request is complete
     * @return int|array|null
     */
    public static function createEdit(
        string $apiKey,
        string $image,
        string $prompt,
        array $extraData = [],
        ?callable $callback = null
    ): mixed {
        return Helper::sendRequest('POST', $apiKey, json_encode(array_merge([
            'image' => $image,
            'prompt' => $prompt
        ], $extraData)), self::API_V1_EDITS, $callback);
    }

    /**
     * Creates a variation of a given image.
     *
     * @param string $apiKey Your OpenAI API key
     * @param string $image The image to use as the basis for the variation(s). Must be a valid PNG file, less than 4MB, and square.
     * @param array $extraData Extra data for the request body
     * @param callable|null $callback Callback function to run when the request is complete
     * @return int|array|null
     */
    public static function createVariation(
        string $apiKey,
        string $image,
        array $extraData = [],
        ?callable $callback = null
    ): mixed {
        return Helper::sendRequest('POST', $apiKey, json_encode(array_merge([
            'image' => $image
        ], $extraData)), self::API_V1_VARIATIONS, $callback);
    }
}
