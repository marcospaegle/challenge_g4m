<?php

/**
 * This is a simple example of how implement the Gear4Music Challenge "OO Programming Challenge 02c".
 * I didn't use any framework or database, just plain PHP and Composer to autoload the classes.
 *
 * @author Marcos Paegle <marcos.paegle@gmail.com>
 */

declare(strict_types=1);

require_once 'vendor/autoload.php';

use Acme\Enums\CouriersEnum;
use Acme\Models\Consignment;
use Acme\Models\Batch;
use Acme\Utils\Dispatchers\Dispatcher;
use Acme\Utils\IDGenerators\ConsignmentIdFactory;

// In a more robust application, the ConsignmentIdFactory would be injected into the class that needs it.
$consignmentIdFactory = new ConsignmentIdFactory();

// The batch should be created and started automatically in someway, but for this example, I'm creating it manually.
$batch = (new Batch())->start();
printf(">>> A new Batch was opened and is ready to receive consignments. Batch ID: %s | Opened at %s\n", $batch->getId(), $batch->getOpenedAt()?->format('Y-m-d H:i:s'));

// In a more robust application, the Consignment will be created after an order been placed
// and the consignmentId will be generated automatically
$consignmentId = $consignmentIdFactory->generateNewId(CouriersEnum::ROYAL_MAIL);
$batch->addConsignment(new Consignment(
    id: $consignmentId,
    courier: CouriersEnum::ROYAL_MAIL
));
printf(">>> A new consignment is added to the Batch. Consignment ID %s | Courier %s\n", $consignmentId, CouriersEnum::ROYAL_MAIL->value);

$batch->addConsignment(new Consignment(
    id: $consignmentId,
    courier: CouriersEnum::ROYAL_MAIL
));
printf(">>> A new consignment is added to the Batch. Consignment ID %s | Courier %s\n", $consignmentId, CouriersEnum::ROYAL_MAIL->value);


$consignmentId = $consignmentIdFactory->generateNewId(CouriersEnum::DHL);
$batch->addConsignment(new Consignment(
    id: $consignmentId,
    courier: CouriersEnum::DHL
));
printf(">>> A new consignment is added to the batch. Consignment ID %s | Courier %s\n", $consignmentId, CouriersEnum::DHL->value);

$consignmentId = $consignmentIdFactory->generateNewId(CouriersEnum::DHL);
$batch->addConsignment(new Consignment(
    id: $consignmentId,
    courier: CouriersEnum::DHL
));
printf(">>> A new consignment is added to the batch. Consignment ID %s | Courier %s\n", $consignmentId, CouriersEnum::DHL->value);

// In the end of the day, the batch should be closed automatically and probably an event dispatched to start the dispatch process.
$batch->close();
printf(">>> The days end and the batch is closed and ready to be processed.Batch ID: %s | Closed at %s\n", $batch->getId(), $batch->getClosedAt()?->format('Y-m-d H:i:s'));

printf(">>> The process to dispatch the consignments to courier started started.\n");
// In a more robust application, the Dispatcher would be injected into the class that needs it.
// The dispatcher will be responsible to send the consignments to the courier.
(new Dispatcher())->dispatch($batch);
