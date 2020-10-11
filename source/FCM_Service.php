<?php
require __DIR__ . './../vendor/autoload.php';

use sngrl\PhpFirebaseCloudMessaging\Client;
use sngrl\PhpFirebaseCloudMessaging\Recipient\Topic;
use sngrl\PhpFirebaseCloudMessaging\Message;
use sngrl\PhpFirebaseCloudMessaging\Notification;
use sngrl\PhpFirebaseCloudMessaging\Recipient\Device;

use GuzzleHttp;
use GuzzleHttp\Psr7\Response;

/**
 * When you run this Php, it send message to added each devices.
 * In this project, 3 devices have.
 * The notification title is 'Title', the notification text is 'Text in Notofication', the message data is 'Hello to receive testing message.'.
 * The message data format is different in every project. In this project, I just used message field.
 */

class FCM_Service {
    private $client;

    //Create Client FCM
    public function __construct($apiKey) {
        $this->client = new Client();
        //Set api key in client
        $this->client->setApiKey($apiKey);
        $this->client->injectGuzzleHttpClient(new \GuzzleHttp\Client());
    }
    public function sendMessage($notofication_title, $notification_text, $notification_data) {
        //Create Notification
        $notification = new Notification($notofication_title, $notification_text);
        $message = new Message();
        $message->setNotification($notification)->setData($notification_data);

        /**
        * Add devices to receive the message.
        * Type is 
        * $message->addRecipient(new Device(DEVICE_TOKEN));
        * The DEVICE_TOKEN is get from each device.
        */
        $message->addRecipient(new Device('dJM4WcIAR_ied6o-E4sE4-:APA91bHtaUe9NJIrnb28UOT6LVOz0QKJaseB2WdVPsxFF4FUW8wW-nRv6lWq0zf6d2ev7lgIBEbtO3ZYuMwTcxcQIH8S0G2wH0MkKppwd9JYz40Yz9fvkXwiu5HJE1J8jHrGMb3nD5uy'));
        $message->addRecipient(new Device('df-2xWBnTweai6gFyIhhyT:APA91bHPtWNk7Ze3yJLTnXe3sqy4AV6Vr90JxZ6_CL9QWvB6Qs5nPRoXI9Q8KpUWAWE94GakwaVEfQ04vpNsuTcdnWlXKcuaOd22-p3attL8xJzEAVwjQPug0X-I03MgsAAdG4n5nYKl'));
        $message->addRecipient(new Device('exZaW1b4TzaINzTP8grWYI:APA91bHf872mK-fzoYCP62LZY63w1AYyFnGoPi_2V4Hw3dubNPIdjSEVZZKHsL2jFGOn1uDHhNG6YDX_zIroKBzZZgNGPfXWm8is11HfPU1a_zbJ6BLOevMY0vHaWKFw59ha7d6zd6j4'));

        $response = $this->client->send($message);
        var_dump($response->getStatusCode());
        var_dump($response->getBody()->getContents());
    }
}
//the message data to send.
$message = 'Hello to receive testing message.';

//the apiKey of Poject in Firebase for cloud message. apiKey is get from Firebase
$apiKey = 'AAAA5Yc9igw:APA91bF59c9irZ1fENJgdAXmGt3tsiyNbofia5VI97gGKe1gZQp-kBiWS3BraUVpSzCePjfMf1JKmvEPPx3nK4A3kOrh69-Pq7zDrO-SrjGwXQWcpPiPS2xnTpjLIGngLecg6yY5xLQa';

//Notification Title
$notofication_title = "Title";
//Notification text
$notification_text = "Text in Notofication";

//Create data of FCM
$notification_data=['message'=>$message];

//Create FCM client
$FCM_Service = new FCM_Service($apiKey);
//Send message to devices
$FCM_Service->sendMessage($notofication_title, $notification_text, $notification_data);