<?php
use App\Http\Controllers\BotManController;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\BotMan\Messages\Outgoing\Question;

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
    $products=\App\Product::all();
    foreach ($products as $product)
        $bot->reply($product->name.$product->img_url);

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
