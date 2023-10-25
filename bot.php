<?php

define('TOKEN_TELEGRAM', '5824228201:AAEBCYaNaQEGnqfdrazTDjG4PNiW8dAsXI8');
define('TOKEN_DISCORD', 'MTA4NDQ1ODE1NzczNDEwNTEzOQ.Gj4yAW.kDZ0cFAY5-F0bd6hua2Wqzbxav1TDN8mrF8ifc');
define('CHANNEL_ID_TELEGRAM', '5824228201');
define('CHANNEL_ID_DISCORD', '1084175599276413053');

    $bot_telegram = new Client(TOKEN_TELEGRAM);

    $bot_discord = new Discord([
        'token' => TOKEN_DISCORD,
    ]);
    $bot_discord->on('ready', function ($discord) {
        echo "Discord Bot is ready!" . PHP_EOL;
    });

    // Функция отправки сообщения в Telegram
function send_to_telegram($text) {
    global $bot_telegram;
    $bot_telegram->sendMessage(new SendMessage(
        CHANNEL_ID_TELEGRAM,
        $text
    ));
}

    // Обработка новых сообщений Discord
    $bot_discord->on('message', function ($message, $discord) {
        global $bot_telegram;
        if ($message->getChannel()->getId() == CHANNEL_ID_DISCORD && !$message->author->bot) {
            // Отправка сообщения в Telegram
            send_to_telegram("[Discord] {$message->author->username}: {$message->content}");
        }
    });

    // Запуск ботов
    $bot_discord->run();
    $bot_telegram->run();