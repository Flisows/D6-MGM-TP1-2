<?php
require_once 'Room.php';
require_once 'Customer.php';
require_once 'Reservation.php';
require_once 'ReservationConflictException.php';

$rooms = [
    new Room(1, '101', 'simple', 100),
    new Room(2, '102', 'double', 150),
    new Room(3, '103', 'suite', 250),
    new Room(4, '201', 'simple', 110),
    new Room(5, '202', 'double', 160)
];

$customers = [
    new Customer(1, 'Alice', 'alice@example.com'),
    new Customer(2, 'Bob', 'bob@example.com'),
    new Customer(3, 'Charlie', 'charlie@example.com')
];

$reservations = [];
try {
    $reservations[] = new Reservation(1, $rooms[0], $customers[0], new DateTime('2023-12-01'), new DateTime('2023-12-05'));
    $reservations[] = new Reservation(2, $rooms[1], $customers[1], new DateTime('2023-12-10'), new DateTime('2023-12-15'));

    foreach ($reservations as $reservation) {
        $reservation->getRoom()->addReservation($reservation);
        $customer = $reservation->getCustomer();
        $customer->addReservation($reservation);
    }
} catch (ReservationConflictException $e) {
    $error = $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reserve'])) {
    $customerName = $_POST['customer_name'];
    $roomNumber = $_POST['room_number'];
    $startDate = new DateTime($_POST['start_date']);
    $endDate = new DateTime($_POST['end_date']);

    $room = null;
    foreach ($rooms as $r) {
        if ($r->getNumber() == $roomNumber) {
            $room = $r;
            break;
        }
    }

    if ($room) {
        try {
            $customer = new Customer(count($customers) + 1, $customerName, '');
            $reservation = new Reservation(count($reservations) + 1, $room, $customer, $startDate, $endDate);
            $room->addReservation($reservation);
            $customer->addReservation($reservation);
            $reservations[] = $reservation;
            $customers[] = $customer;
            $success = "Réservation effectuée avec succès!";
        } catch (ReservationConflictException $e) {
            $error = $e->getMessage();
        }
    } else {
        $error = "Chambre non trouvée.";
    }
}

$totalRevenue = 0;
foreach ($reservations as $reservation) {
    $totalRevenue += $reservation->calculateAmount();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Réservations d'Hôtel</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Gestion de Réservations d'Hôtel</h1>

    <h2>Chiffre d'affaires total pour le mois en cours: <?php echo $totalRevenue; ?></h2>

    <h2>Historique des Réservations</h2>
    <?php foreach ($customers as $customer): ?>
        <h3>Client: <?php echo $customer->getName(); ?></h3>
        <ul>
            <?php foreach ($customer->getReservationHistory() as $reservation): ?>
                <li>
                    Chambre: <?php echo $reservation->getRoom()->getNumber(); ?>,
                    Du: <?php echo $reservation->getStartDate()->format('Y-m-d'); ?>
                    au <?php echo $reservation->getEndDate()->format('Y-m-d'); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>

    <h2>Réserver une Chambre</h2>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <?php if (isset($success)): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php endif; ?>
    <form method="post" action="index.php">
        <label for="customer_name">Nom du Client:</label>
        <input type="text" id="customer_name" name="customer_name" required>

        <label for="room_number">Numéro de la Chambre:</label>
        <select id="room_number" name="room_number" required>
            <?php foreach ($rooms as $room): ?>
                <option value="<?php echo $room->getNumber(); ?>"><?php echo $room->getNumber(); ?></option>
            <?php endforeach; ?>
        </select>

        <label for="start_date">Date de Début:</label>
        <input type="date" id="start_date" name="start_date" required>

        <label for="end_date">Date de Fin:</label>
        <input type="date" id="end_date" name="end_date" required>

        <button type="submit" name="reserve">Réserver</button>
    </form>
</body>
</html>
