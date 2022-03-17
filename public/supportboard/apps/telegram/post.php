<?php

/*
 * ==========================================================
 * TELEGRAM POST.PHP
 * ==========================================================
 *
 * Telegram response listener. This file receive the messages sent to the Telegram bot. This file requires the Telegram App.
 * © 2017-2022 board.support. All rights reserved.
 *
 */

$raw = file_get_contents('php://input');
$response = json_decode($raw, true);
if ($response) {
    if (isset($response['message'])) {
        require('../../include/functions.php');
        $GLOBALS['SB_FORCE_ADMIN'] = true;
        sb_cloud_load_by_url();
        $response_message = $response['message'];
        $from = $response_message['from'];
        $chat_id = $response_message['chat']['id'];
        $message = isset($response_message['text']) ? $response_message['text'] : $response_message['caption'];
        $attachments = [];
        $token = sb_get_multi_setting('telegram', 'telegram-token');
        $user_id = false;

        // User and conversation
        $username = isset($from['username']) ? $from['username'] : $from['id'];
        $user = sb_get_user_by('telegram-id', $username);
        if (!$user) {
            $extra = ['telegram-id' => [$username, 'Telegram ID']];
            $profile_image = sb_get('https://api.telegram.org/bot' . $token . '/getUserProfilePhotos?user_id=' . $from['id'], true);
            if (!empty($profile_image['ok'])) {
                $photos = $profile_image['result']['photos'][0];
                $profile_image = sb_telegram_download_file($photos[count($photos) - 1]['file_id'], $token);
            } else $profile_image = '';
            if (isset($from['language_code'])) {
                $extra['language'] = [$from['language_code'], 'Language'];
            } else if (sb_get_multi_setting('dialogflow-language-detection', 'dialogflow-language-detection-active')) {
                $detected_language = sb_google_language_detection($message);
                if (!empty($detected_language)) $extra['language'] = [$detected_language, 'Language'];
            }
            $user_id = sb_add_user(['first_name' => sb_isset($from, 'first_name', ''), 'last_name' => sb_isset($from, 'last_name', ''), 'profile_image' => sb_is_error($profile_image) || empty($profile_image) ? '' : $profile_image, 'user_type' => 'lead'], $extra);
            $user = sb_get_user($user_id);
        } else {
            $user_id = $user['id'];
            $conversation_id = sb_isset(sb_db_get('SELECT id FROM sb_conversations WHERE source = "tg" AND user_id = ' . $user_id . ' ORDER BY id DESC LIMIT 1'), 'id');
        }
        $GLOBALS['SB_LOGIN'] = $user;
        if (!$conversation_id) $conversation_id = sb_isset(sb_new_conversation($user_id, 2, '', sb_get_setting('telegram-department'), -1, 'tg', $chat_id), 'details', [])['id'];

        // Attachments
        $document = sb_isset($response_message, 'document');
        $photos = sb_isset($response_message, 'photo');
        if ($document) {
            array_push($attachments, [$document['file_name'], sb_telegram_download_file($document['file_id'], $token)]);
        }
        if ($photos) {
            $url = sb_telegram_download_file($photos[count($photos) - 1]['file_id'], $token);
            array_push($attachments, [substr($url, strripos($url, '/') + 1), $url]);
        }

        // Send message
        $response = sb_send_message($user_id, $conversation_id, $message, $attachments, 2);

        // Dialogflow, Notifications, Bot messages
        $response_extarnal = sb_messaging_platforms_functions($conversation_id, $message, $attachments, $user, ['source' => 'tg', 'chat_id' => $chat_id]);

        // Online status
        sb_update_users_last_activity($user_id);

        $GLOBALS['SB_FORCE_ADMIN'] = false;
    }
}
die();

?>