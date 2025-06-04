<?php
class ReservationConflictException extends Exception {
    public function __construct($message = "La chambre est déjà réservée pour cette période.", $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
?>
