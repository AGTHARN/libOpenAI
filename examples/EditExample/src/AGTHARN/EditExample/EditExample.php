<?php

declare(strict_types=1);

namespace AGTHARN\EditExample;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\utils\TextFormat;
use AGTHARN\libOpenAI\Client;

class EditExample extends PluginBase implements Listener
{
    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onPlayerChat(PlayerChatEvent $event): void
    {
        if (count($this->getServer()->getOnlinePlayers()) === 1) {
            $split = explode(': ', $event->getMessage());
            if (count($split) !== 2) {
                return;
            }

            Client::init('YOUR_API_KEY')->edits()->create($split[1], $split[0], 'text-davinci-edit-001', [], function (array $result) {
                $this->getServer()->broadcastMessage(TextFormat::GREEN . trim($result['choices'][0]['text']));
            });
        }
    }
}
