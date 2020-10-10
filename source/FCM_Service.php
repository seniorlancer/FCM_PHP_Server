<?php
require __DIR__ . './../vendor/autoload.php';

use sngrl\PhpFirebaseCloudMessaging\Client;
use sngrl\PhpFirebaseCloudMessaging\Recipient\Topic;
use sngrl\PhpFirebaseCloudMessaging\Message;
use sngrl\PhpFirebaseCloudMessaging\Notification;
use sngrl\PhpFirebaseCloudMessaging\Recipient\Device;

use GuzzleHttp;
use GuzzleHttp\Psr7\Response;


class FCM_Service {
    private $client;

    public function __construct($apiKey) {
        $this->client = new Client();
        $this->client->setApiKey($apiKey);
        $this->client->injectGuzzleHttpClient(new \GuzzleHttp\Client());
    }
    public function sendMessage($notofication_title, $notification_text, $notification_data) {
        $notification = new Notification($notofication_title, $notification_text);
        $message = new Message();
        $message->setNotification($notification)->setData($notification_data);
        $message->addRecipient(new Device('dJM4WcIAR_ied6o-E4sE4-:APA91bHtaUe9NJIrnb28UOT6LVOz0QKJaseB2WdVPsxFF4FUW8wW-nRv6lWq0zf6d2ev7lgIBEbtO3ZYuMwTcxcQIH8S0G2wH0MkKppwd9JYz40Yz9fvkXwiu5HJE1J8jHrGMb3nD5uy'));
        $message->addRecipient(new Device('df-2xWBnTweai6gFyIhhyT:APA91bHPtWNk7Ze3yJLTnXe3sqy4AV6Vr90JxZ6_CL9QWvB6Qs5nPRoXI9Q8KpUWAWE94GakwaVEfQ04vpNsuTcdnWlXKcuaOd22-p3attL8xJzEAVwjQPug0X-I03MgsAAdG4n5nYKl'));
        
        $response = $this->client->send($message);
    }
}

$apiKey = 'AAAA5Yc9igw:APA91bF59c9irZ1fENJgdAXmGt3tsiyNbofia5VI97gGKe1gZQp-kBiWS3BraUVpSzCePjfMf1JKmvEPPx3nK4A3kOrh69-Pq7zDrO-SrjGwXQWcpPiPS2xnTpjLIGngLecg6yY5xLQa';

$notofication_title = "Title";
$notification_text = "Text in Notofication";

$notification_data=['to'=>'Your Device', 'notification'=>'Hello to receive testing message.'];

$FCM_Service = new FCM_Service($apiKey);
$FCM_Service->sendMessage($notofication_title, $notification_text, $notification_data);