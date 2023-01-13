<?php

declare(strict_types=1);

namespace AGTHARN\CompletionExample;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use AGTHARN\libOpenAI\api\CompletionsAPI;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\utils\TextFormat;

class CompletionExample extends PluginBase implements Listener
{
    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onPlayerChat(PlayerChatEvent $event): void
    {
        if (count($this->getServer()->getOnlinePlayers()) === 1) {
            CompletionsAPI::create('YOUR_API_KEY', $event->getMessage(), 'text-davinci-003', [
                'max_tokens' => 2048 // NOTE: if you wonder why your replies are cut off, it's because the default is 16
            ], function (?array $result) {
                if ($result !== null) {
                    $this->getServer()->broadcastMessage(TextFormat::GREEN . trim($result['choices'][0]['text']));
                }
            });
        }
    }
}
