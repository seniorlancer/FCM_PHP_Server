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
    public function sendMessage($header, $context) {
        $notification = new Notification($header, $context);
        $message = new Message();
        $message->setNotification($notification);
        $message->addRecipient(new Device('df-2xWBnTweai6gFyIhhyT:APA91bHPtWNk7Ze3yJLTnXe3sqy4AV6Vr90JxZ6_CL9QWvB6Qs5nPRoXI9Q8KpUWAWE94GakwaVEfQ04vpNsuTcdnWlXKcuaOd22-p3attL8xJzEAVwjQPug0X-I03MgsAAdG4n5nYKl'));
        $message->addRecipient(new Device('c8Q_E3oAQFeZ-mKm6G-qxQ:APA91bG-WAtzxSTfRMlg8EGuLiMBz-ZdXqVDZOCM67l-heAV7DUnum1u2IBvDc4wtVRCm0ryrPH4WLM2XcBvramJAbE6SZU5ZU_M7-vYgRh-QWu3DuiPdAGoGqkuFRKUvTelVC9E8DS8'));

        $response = $this->client->send($message);
    }
}


$apiKey = 'AAAA5Yc9igw:APA91bF59c9irZ1fENJgdAXmGt3tsiyNbofia5VI97gGKe1gZQp-kBiWS3BraUVpSzCePjfMf1JKmvEPPx3nK4A3kOrh69-Pq7zDrO-SrjGwXQWcpPiPS2xnTpjLIGngLecg6yY5xLQa';

$FCM_Service = new FCM_Service($apiKey);
$FCM_Service->sendMessage("Test Message", "This is a testing message for push notification.");