<?php
class Room {
    private $id;
    private $number;
    private $type;
    private $pricePerNight;
    private $reservations = [];

    public function __construct($id, $number, $type, $pricePerNight) {
        $this->id = $id;
        $this->number = $number;
        $this->type = $type;
        $this->pricePerNight = $pricePerNight;
    }

    public function isAvailable(DateTime $start, DateTime $end): bool {
        foreach ($this->reservations as $reservation) {
            $reservationStart = $reservation->getStartDate();
            $reservationEnd = $reservation->getEndDate();

            // Vérifie si les périodes se chevauchent
            if ($start < $reservationEnd && $end > $reservationStart) {
                return false;
            }
        }
        return true;
    }

    public function addReservation(Reservation $reservation) {
        if (!$this->isAvailable($reservation->getStartDate(), $reservation->getEndDate())) {
            throw new ReservationConflictException();
        }
        $this->reservations[] = $reservation;
    }

    public function getReservations() {
        return $this->reservations;
    }

    public function getId() {
        return $this->id;
    }

    public function getNumber() {
        return $this->number;
    }

    public function getPricePerNight() {
        return $this->pricePerNight;
    }
}
?>
