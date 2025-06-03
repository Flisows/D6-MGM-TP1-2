<?php
$notifications = [
    new NotificationEmail(),
    new NotificationSMS(),
    new NotificationPush()
];

foreach ($notifications as $notification) {
    $notification->envoyerNotification();
}
?>
