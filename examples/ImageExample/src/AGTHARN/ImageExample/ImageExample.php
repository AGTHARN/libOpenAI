<?php

declare(strict_types=1);

namespace AGTHARN\ImageExample;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use AGTHARN\libOpenAI\api\ImagesAPI;
use pocketmine\event\player\PlayerChatEvent;

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

            ImagesAPI::create('YOUR_API_KEY', $prompt, [], null, function (?array $result) use ($dataFolder) {
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
