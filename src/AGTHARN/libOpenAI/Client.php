<?php

declare(strict_types=1);

namespace AGTHARN\libOpenAI;

use AGTHARN\libOpenAI\api\type\Edits;
use AGTHARN\libOpenAI\api\type\Files;
use AGTHARN\libOpenAI\api\type\Images;
use AGTHARN\libOpenAI\api\type\Models;
use AGTHARN\libOpenAI\api\type\Engines;
use AGTHARN\libOpenAI\api\type\FineTunes;
use AGTHARN\libOpenAI\api\type\Embeddings;
use AGTHARN\libOpenAI\api\type\Completions;
use AGTHARN\libOpenAI\api\type\Moderations;

class Client
{
    public static function init(string $apiKey): Client
    {
        return new Client($apiKey);
    }

    public function __construct(
        private readonly string $apiKey
    ) {
    }

    public function models(): Models
    {
        return new Models($this->apiKey);
    }

    public function completions(): Completions
    {
        return new Completions($this->apiKey);
    }

    public function edits(): Edits
    {
        return new Edits($this->apiKey);
    }

    public function images(): Images
    {
        return new Images($this->apiKey);
    }

    public function embeddings(): Embeddings
    {
        return new Embeddings($this->apiKey);
    }

    public function files(): Files
    {
        return new Files($this->apiKey);
    }

    public function fineTunes(): FineTunes
    {
        return new FineTunes($this->apiKey);
    }

    public function moderations(): Moderations
    {
        return new Moderations($this->apiKey);
    }

    /**
     * @deprecated The Engines endpoints are DEPRECATED. Use Models instead.
     */
    public function engines(): Engines
    {
        return new Engines($this->apiKey);
    }
}
