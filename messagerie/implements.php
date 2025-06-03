<?php
class NotificationEmail implements Notifiable {
    public function envoyerNotification() {
        echo "Envoi d'un email de notification.\n";
    }
}

class NotificationSMS implements Notifiable {
    public function envoyerNotification() {
        echo "Envoi d'un SMS de notification.\n";
    }
}

class NotificationPush implements Notifiable {
    public function envoyerNotification() {
        echo "Envoi d'une notification push.\n";
    }
}
?>
