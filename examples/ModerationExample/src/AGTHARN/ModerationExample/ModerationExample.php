<?php

declare(strict_types=1);

namespace AGTHARN\ModerationExample;

use AGTHARN\libOpenAI\Client;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerChatEvent;

class ModerationExample extends PluginBase implements Listener
{
    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onPlayerChat(PlayerChatEvent $event): void
    {
        if (count($this->getServer()->getOnlinePlayers()) === 1) {
            Client::init('YOUR_API_KEY')->moderations()->create($event->getMessage(), [], function (array $result) use ($event) {
                if ($result['results'][0]['flagged']) {
                    $event->getPlayer()->sendMessage(TextFormat::RED . 'Your message was flagged as inappropriate!');
                } else {
                    $this->getServer()->broadcastMessage($this->getServer()->getLanguage()->translateString($event->getFormat(), [$event->getPlayer()->getDisplayName(), $event->getMessage()]), $event->getRecipients());
                }
            });
            $event->cancel();
        }
    }
}
