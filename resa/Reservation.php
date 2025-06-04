<?php
interface Billable {
    public function calculateAmount(): float;
}

class Reservation implements Billable {
    private $id;
    private $room;
    private $customer;
    private $startDate;
    private $endDate;
    private $status;

    public function __construct($id, Room $room, Customer $customer, DateTime $startDate, DateTime $endDate) {
        $this->id = $id;
        $this->room = $room;
        $this->customer = $customer;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->status = 'pending';
    }

    public function calculateAmount(): float {
        $duration = $this->getDurationInNights();
        return $duration * $this->room->getPricePerNight();
    }

    public function cancel() {
        $this->status = 'canceled';
    }

    public function getDurationInNights() {
        $interval = $this->startDate->diff($this->endDate);
        return $interval->days;
    }

    public function getRoom() {
        return $this->room;
    }

    public function getCustomer() {
        return $this->customer;
    }

    public function getStartDate() {
        return $this->startDate;
    }

    public function getEndDate() {
        return $this->endDate;
    }
}
?>
