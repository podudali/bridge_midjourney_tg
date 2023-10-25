<?php

require __DIR__.'/vendor/autoload.php'; // Путь к файлу autoload.php библиотеки

use Discord\Builders\InteractionBuilder;
use Discord\Parts\Interaction\Interaction;


// Создание экземпляра клиента Discord
$token = 'MTA4NDE3NDcxNjU2ODM0MjYwMQ.GolH7e.7JQxi5ndgSpb2jx5_0guhAHjFc7Mzb4wKIDKC8'; // Замените YOUR_BOT_TOKEN_HERE на токен своего бота
$client = new Discord\Discord([
    'token' => $token,
]);

// Обработка события ready
$client->on('ready', function ($discord) {
    echo "Discord клиент успешно запущен!" . PHP_EOL;
});

// Обработка события message
$client->on('message', function ($message, $discord) {
    if ($message->content === '/imagine prompt: ') { // Замените /test на команду, которую вы хотите использовать
        $applicationId = '1084175599276413053'; // Замените 123456789012345678 на ID приложения бота
        $commandId = '1089227828786122843'; // Замените 123456789012345678 на ID команды, которую вы хотите использовать
        $builder = new InteractionBuilder($discord->getId(), $message->channel_id, $applicationId, $commandId);
        $interaction = $builder->createInteraction();
        $interaction->send();
        $reply = $interaction->getReply();
        if ($reply instanceof Interaction) {
            echo 'Slash-команда успешно выполнена!';
        } else {
            echo 'Ошибка выполнения Slash-команды: '.$reply->message;
        }
    }
});

// Запуск клиента
$client->run();