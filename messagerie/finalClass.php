<?php
final class NotificationSystem {
    public function log($message) {
        echo "Log : " . $message . "\n";
    }
}

class ExtendedNotificationSystem extends NotificationSystem {
    // error
}
?>
