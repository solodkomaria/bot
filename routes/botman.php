<?php
use App\Http\Controllers\BotManController;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');

    $question = Question::create('Do you need a database?')
        ->fallback('Unable to create a new database')
        ->callbackId('create_database')
        ->addButtons([
            Button::create('Of course')->value('1'),
            Button::create('Hell no!')->value('2'),
        ]);

    $bot->reply($question);

});
$botman->hears('1', function ($bot) {
    $bot->reply("Tell me more!1");
    $bot->reply("And even more");
});

$botman->hears('2', function ($bot) {
    $bot->reply("Tell me more!2");
    $bot->reply("And even more");
});

$botman->hears('img', function ( $bot) {
    // Create attachment
    $attachment = new Image('https://botman.io/img/logo.png');

    // Build message object
    $message = OutgoingMessage::create('This is my text')
        ->withAttachment($attachment);

    // Reply message object
    $bot->reply($message);
});
$botman->hears('Start conversation', BotManController::class.'@startConversation');
