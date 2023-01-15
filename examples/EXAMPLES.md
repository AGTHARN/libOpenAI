# Usage Examples
This document is not yet completed! You may fully explore your options with the [documentation](https://beta.openai.com/docs/api-reference/completions) or by looking through the source code of this library.

## Table of Contents
- [Completions](#%EF%B8%8F-completions)
- [Edits](#%EF%B8%8F-edits)
- [Images](#%EF%B8%8F-images)
- [Moderations](#%EF%B8%8F-moderations)

## ➡️ Completions
Given a prompt, the model will return one or more predicted completions, and can also return the probabilities of alternative tokens at each position.

- [Example Plugin](https://github.com/AGTHARN/libOpenAI/tree/main/examples/CompletionExample)

Usage:
```php
Client::init('YOUR_API_KEY')->completions()->create('what is 9+10?', 'text-davinci-003', [
    'max_tokens' => 2048 // NOTE: if you wonder why your replies are cut off, it's because the default is 16
], function (?array $result) {
    if ($result !== null) {
        $this->getServer()->broadcastMessage(TextFormat::GREEN . trim($result['choices'][0]['text']));
    }
});
```

![image](https://media.discordapp.net/attachments/489366022172966922/1063339428266901554/image.png?width=1440&height=353)

*Idea: Interactable Q&A bot after fine-tuning the model. This can greatly increase Fine-tuning training and Model usage costs if used irresponsibly.*

## ➡️ Edits
Given a prompt and an instruction, the model will return an edited version of the prompt.

- [Example Plugin](https://github.com/AGTHARN/libOpenAI/tree/main/examples/EditExample)

Usage:
```php
Client::init('YOUR_API_KEY')->edits()->create('What day of the wek is it?', 'Fix the spelling mistakes', 'text-davinci-edit-001', [], function (?array $result) {
    if ($result !== null) {
        $this->getServer()->broadcastMessage(TextFormat::GREEN . trim($result['choices'][0]['text']));
    }
});
```

![image](https://media.discordapp.net/attachments/489366022172966922/1063383533655162950/image.png?width=500&height=130)

*Idea: Automatically fix spelling mistakes in chat. If I am not wrong, this does not incur any usage costs. However, this may change in the future so please confirm that yourself.*

## ➡️ Images
Given a prompt and/or an input image, the model will generate a new image. There are also image edits and image variations not shown in the example. Related guide: [Image generation](https://beta.openai.com/docs/guides/images).

- [Example Plugin](https://github.com/AGTHARN/libOpenAI/tree/main/examples/ImageExample)

Usage:
```php
// NOTE: use the asynchronous callback parameter provided to prevent file_put_contents from blocking the main thread
Client::init('YOUR_API_KEY')->images()->create('minecraft', [], null, function (?array $result) use ($dataFolder) {
    if ($result !== null) {
        $image = file_get_contents($result['data'][0]['url']);
        if ($image !== false) {
            file_put_contents($dataFolder . 'image.png', $image);
        }
    }
});
```

prompt: `minecraft`

![image](https://media.discordapp.net/attachments/489366022172966922/1063619319302463529/image.png?width=300&height=300)

*Idea: Allow players to generate images with a command and have it put up as maps on item frames. This can greatly increase DALL·E API usage costs if used irresponsibly.*

## ➡️ Moderations
Given a input text, outputs if the model classifies it as violating OpenAI's content policy. Related guide: [Moderations](https://beta.openai.com/docs/guides/moderation).

- [Example Plugin](https://github.com/AGTHARN/libOpenAI/tree/main/examples/ModerationExample)

Usage:
```php
Client::init('YOUR_API_KEY')->moderations()->create('I want to kill them.', [], function (?array $result) use ($player) {
    if ($result !== null && $result['results'][0]['flagged']) {
        $player->sendMessage('Your message was flagged as inappropriate!');
    }
});
```

![image](https://media.discordapp.net/attachments/489366022172966922/1063762528158617681/image.png?width=500&height=130)

*Idea: Automatically filter out inappropriate messages. This can greatly increase Model usage costs if used irresponsibly.*