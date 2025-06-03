<?php
class NotificationEmail {
    public function envoyerNotification() {
        echo "Envoi d'un email de notification.\n";
    }

    final public function configurerServeurSMTP() {
        echo "Configuration du serveur SMTP.\n";
    }
}

class NotificationEmailAvancee extends NotificationEmail {

    public function configurerServeurSMTP() {
        // error
    }
}
?>
