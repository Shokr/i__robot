<?php
/**
 * i__robot: A sentiment analysis bot
 * User: shokr
 * Date: 29-Aug-16
 * Time: 3:01 PM
 */

use DetectLanguage\DetectLanguage;
use MonkeyLearn\Client as MonkeyLearn;
use Codebird\Codebird;


require 'vendor/autoload.php';

// MonkeyLearn api
$ml = new MonkeyLearn('80b38f6f41a00c09913561c37188b4d58ccfea02');


// Detect Language API
DetectLanguage::setApiKey("ff042d9645e37100721ce652f2c05693");



Codebird::setConsumerKey('AarqtyGvTMSnFuUVmhHPMaEeS','CLMjktiDabLgoUBAFx2AZBnQcgsWE93HxtwDNmh26kBl6O4UoC');


$cb = Codebird::getInstance();
$cb->setReturnFormat(CODEBIRD_RETURNFORMAT_ARRAY);

$cb->setToken('769873996049444864-vQrEcatGcwMFwjM6bPszbG0FbFODqHO','ZJsPfoydgDc82fhfRPYZ4zrnU3Sa5HBfYXGHZTfPSOXvN');

$mentions = $cb->statuses_mentionsTimeline();


if (!isset($mentions[0])) {
    return;
}

// Emojis

$happyEmojis = [
    '&#x1F601;',
    '&#x1F602;',
    '&#x1F603;',
    '&#x1F604;',
    '&#x1F605;',
    '&#x1F606;',
    '&#x1F609;',
    '&#x1F60A;',
    '&#x1F60C;',
    '&#x1F600;',
    '&#x1F44D;',
    '&#x1F44C;',
    '&#x1F438;',
    '&#x1F339;',
];

$neutralEmojis = [
    '&#x1F610;',
    '&#x1F611;',
    '&#x1F636;',
    '&#x1F644;',
    '&#x1F64C;',
];

$sadEmojis = [
    '&#x1F612;',
    '&#x1F613;',
    '&#x1F614;',
    '&#x1F616;',
    '&#x1F61E;',
    '&#x1F620;',
    '&#x1F621;',
    '&#x1F622;',
    '&#x1F623;',
    '&#x1F625;',
    '&#x1F629;',
    '&#x1F62D;',
    '&#x1F631;',
    '&#x1F44E;',
    '&#x1F61F;',
];

// emojis-END


$tweets = [];

foreach ($mentions as $index => $mention) {
    if (isset($mention['id'])) {
        $tweets[] = [
            'id' => $mention['id'],
            'user_screen_name' => $mention['user']['screen_name'],
            'text' => $mention['text'],
        ];
    }
}


$tweetsText = array_map(function ($tweet) {
    return $tweet['text'];
}, $tweets);


//$langDetection = $ml->classifiers->classify($module_id, $tweetsText, true);
//$languageCode = DetectLanguage::simpleDetect($tweetsText);
//var_dump($languageCode);


foreach ($tweets as $index => $tweet) {
    switch (strtolower(DetectLanguage::simpleDetect($tweet['text']))) {
        case 'ar':
            $res = $ml->classifiers->classify('cl_hyudFbJX', $tweetsText, true);

            switch (strtolower($res->result[$index][0]['label'])) {
                case 'positive':
                    $emojiSet = $happyEmojis;
                    break;
                case 'negative':
                    $emojiSet = $sadEmojis;
                    break;
            }

            break;
        case 'en':

            $res = $ml->classifiers->classify('cl_qkjxv9Ly', $tweetsText, true);

            switch (strtolower($res->result[$index][0]['label'])) {
                case 'positive':
                    $emojiSet = $happyEmojis;
                    break;
                case 'neutral':
                    $emojiSet = $neutralEmojis;
                    break;
                case 'negative':
                    $emojiSet = $sadEmojis;
                    break;
            }

            break;
    }

    //var_dump($emojiSet);
}

// track
// reply