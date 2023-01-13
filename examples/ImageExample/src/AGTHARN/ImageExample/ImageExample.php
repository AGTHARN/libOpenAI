<?php

declare(strict_types=1);

namespace AGTHARN\ImageExample;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use AGTHARN\libOpenAI\api\ImagesAPI;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\utils\TextFormat;

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

            // Run the downloading of the image asynchronously please, this is just an example. 
            ImagesAPI::create('YOUR_API_KEY', $prompt, [], function (?array $result) {
                if ($result !== null) {
                    $image = file_get_contents($result['data'][0]['url']);
                    if ($image !== false) {
                        $this->getServer()->broadcastMessage(TextFormat::GREEN . 'Image downloaded!');
                        file_put_contents($this->getDataFolder() . 'image.png', $image);
                    }
                }
            });
        }
    }
}
