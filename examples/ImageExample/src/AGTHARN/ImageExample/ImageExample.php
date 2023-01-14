<?php

declare(strict_types=1);

namespace AGTHARN\ImageExample;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerChatEvent;
use AGTHARN\libOpenAI\Client;

class ImageExample extends PluginBase implements Listener
{
    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onPlayerChat(PlayerChatEvent $event): void
    {
        if (count($this->getServer()->getOnlinePlayers()) === 1 && str_contains($event->getMessage(), 'create image: ')) {
            $prompt = str_replace('create image: ', '', $event->getMessage());
            $dataFolder = $this->getDataFolder();

            Client::init('YOUR_API_KEY')->images()->create($prompt, [], null, function (?array $result) use ($dataFolder) {
                if ($result !== null) {
                    $image = file_get_contents($result['data'][0]['url']);
                    if ($image !== false) {
                        file_put_contents($dataFolder . 'image.png', $image);
                    }
                }
            });
        }
    }
}
