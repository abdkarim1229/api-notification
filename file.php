<?php
function sendPushNotification($fcm_token, $title, $message, $id = null,$action = null) {  
     
    $url = "https://fcm.googleapis.com/fcm/send";            
    $header = [
        'authorization: key=<AAAAiabun4Q:APA91bEsGEYSSDHiB8jDgCyElHc7x2UzixmHUhTbGmdjowHw2PuJ2XMjrL7_X-Q1rX6SX50hKZ2W_oXy4PUYxrOLD-evQTYSpvnMMDzqCql1u60pCp6_DwLQuwvXk44OKLkqKmcX4j-Z>',
        'content-type: application/json'
    ];    
 
    $notification = [
        'title' =>$title,
        'body' => $message
    ];
    $extraNotificationData = ["message" => $notification,"id" =>$id,'action'=>$action];
 
    $fcmNotification = [
        'to'        => $fcm_token,
        'notification' => $notification,
        'data' => $extraNotificationData
    ];
 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
 
    $result = curl_exec($ch);    
    curl_close($ch);
 
    return $result;
}