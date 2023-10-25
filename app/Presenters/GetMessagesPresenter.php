<?php

namespace App\Presenters;

use Nette;
use Longman\TelegramBot\Telegram;
use App\Presenters\BasePresenter;
use GuzzleHttp\Client;
use Discord\DiscordCommandClient;
use Discord\Http\Drivers;
use Nette\Database\Explorer;

class GetMessagesPresenter extends BasePresenter{

    /**
     * @param Explorer
     */
    private $database;
public function __construct(Explorer $database){
    $this->database = $database;
}

public function renderDefault(){
$fields = $this->database->table('discord');
foreach($fields as $field){
    $id_discord = $field->id;
    $guildId_discord = $field->guildId;
    $channelId_discord = $field->channelId;
    $application_id_discord = $field->application_id;
    $command_id_discord = $field->command_id;
    $midjourney_id_discord = $field->midjourney_id;
    $token_discord = $field->token;
    $token_bot_discord = $field->token_bot;
}
// // Получаем токен бота Discord
$token = $token_discord;
$token_bot = $token_bot_discord;

// // Получаем ID сервера и канала, где хотим выполнить команду
$guildId = $guildId_discord;
$channelId = $channelId_discord;
$application_id = $application_id_discord;
$command_id = $command_id_discord;
$midjourney_id = $midjourney_id_discord;

$headers = [
    "Authorization: Bot {$token_bot}",
    "Content-Type: application/json"
];

// Отправляем запрос к команде на уровне сервера
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://discord.com/api/v8/applications/{$application_id}/guilds/{$guildId}/commands/{$command_id}");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
curl_close($ch);

// Выводим результат в формате JSON
echo $result;

$webhookUrl = 'https://discord.com/api/webhooks/1088480294228733983/wF2yW85g25D55KSJ4JQcng4cWK9jfStC-B2CneL3yH40mw82ZmHqahD8zIHCao2NhgKu';
}
}