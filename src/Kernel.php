<?php

namespace App;

use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Telegram\TelegramDriver;

class Kernel
{
    protected $bot;

    public function __construct()
    {
        DriverManager::loadDriver(TelegramDriver::class);

        $config = [
            'telegram' => [
                'token' => getenv('TELEGRAM_TOKEN')
            ]
        ];

        $this->bot = BotManFactory::create($config);
    }

    public function setRoutes($routes = [])
    {
        foreach ($routes as $keyword => $handler) {
            $this->bot->hears($keyword, $handler);
        }
    }

    public function handle()
    {
        $this->bot->listen();
    }
}