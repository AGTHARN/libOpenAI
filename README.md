# libOpenAI (A PocketMine-MP Library)
[![Hits](https://hits.sh/github.com/AGTHARN/libOpenAI.svg?view=today-total&style=flat-square)](https://hits.sh/github.com/AGTHARN/libOpenAI/)

![image](https://media.discordapp.net/attachments/489366022172966922/1063325869340364830/0_c-PJKeN6JqEUKyZ8.png?width=600&height=337)

A PocketMine-MP library which allows developers to make use of OpenAI's API. Please always keep this library up-to-date as this is subject to a lot of changes in the future. If you're attempting to use this library, please make sure you have a valid [OpenAI API key](https://beta.openai.com/account/api-keys).

> **Note**: OpenAI is still in its early stages of development and some areas are still in beta. Please be cautious when using this library for production use. The [documentation](https://beta.openai.com/docs) on OpenAI's website should be read to fully understand the function of this library.

## Usage
This PocketMine-MP library allows server developers to use [OpenAI's public API](https://beta.openai.com/docs). This library should be fairly simple to use and easy to understand. You can either run the library asynchronously or synchronously.

[Examples](https://github.com/AGTHARN/libOpenAI/blob/main/examples/EXAMPLES.md)

> **Warning**: If you would like to run the methods asynchronously, please make pass a function to the `callback` parameter which would be run after asynchronous execution. If left as null, it will run synchronously but I do not recommend it as it will block the main thread.

### *This repository is not affiliated, sponsored, or authorized by OpenAI or any of its trademarks. All trademarks are the property of their respective owners.*