<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => false,

    'http' => [
        'server_key' => env('FCM_SERVER_KEY', 'AAAAN7iGVy4:APA91bFtJDMAy5yX9K4Klo_HQKtyQcIx1RSzmrVRJj7YgXAur7Q8WISBMNskMUqcnTpUr0pwQfc3xQuY0SSW1N-7Qwpi8baRPVg55bcMuVNjnf3y4p0uqDudlja96mmADDVp4GYpx3H9'),
        'sender_id' => env('FCM_SENDER_ID', '239319013166'),
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 30.0, // in second
    ],
];
