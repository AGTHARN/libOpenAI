<?php

declare(strict_types=1);

namespace AGTHARN\libOpenAI\api;

abstract class API
{
    public function __construct(
        public string $apiKey
    ) {
    }
}
