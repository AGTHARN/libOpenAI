# Usage Examples
This document is not yet completed! You may fully explore your options with the [documentation](https://beta.openai.com/docs/api-reference/completions) or by looking through the source code of this library.

## Table of Contents
- [Completions](#%EF%B8%8F-completions)
- [Edits](#%EF%B8%8F-edits)
- [Images](#%EF%B8%8F-images)

## ➡️ Completions
Given a prompt, the model will return one or more predicted completions, and can also return the probabilities of alternative tokens at each position.

[Example Plugin](https://github.com/AGTHARN/libOpenAI/tree/main/examples/CompletionExample)

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

## ➡️ Edits
Given a prompt and an instruction, the model will return an edited version of the prompt.

[Example Plugin](https://github.com/AGTHARN/libOpenAI/tree/main/examples/EditExample)

Usage:
```php
Client::init('YOUR_API_KEY')->edits()->create('What day of the wek is it?', 'Fix the spelling mistakes', 'text-davinci-edit-001', [], function (?array $result) {
    if ($result !== null) {
        $this->getServer()->broadcastMessage(TextFormat::GREEN . trim($result['choices'][0]['text']));
    }
});
```

![image](https://media.discordapp.net/attachments/489366022172966922/1063383533655162950/image.png?width=500&height=130)

## ➡️ Images
Given a prompt and/or an input image, the model will generate a new image. Related guide: [Image generation](https://beta.openai.com/docs/guides/images). *There are also image edits and image variations.*

[Example Plugin](https://github.com/AGTHARN/libOpenAI/tree/main/examples/ImageExample)

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
