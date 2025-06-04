<?php
class Customer {
    private $id;
    private $name;
    private $email;
    private $reservations = [];

    public function __construct($id, $name, $email) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function addReservation(Reservation $reservation) {
        $this->reservations[] = $reservation;
    }

    public function getReservationHistory() {
        return $this->reservations;
    }

    public function getName() {
        return $this->name;
    }
}
?>
