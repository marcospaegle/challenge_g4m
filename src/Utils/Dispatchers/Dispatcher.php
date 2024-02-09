<?php

declare(strict_types=1);

namespace Acme\Utils\Dispatchers;

use Acme\Enums\CouriersEnum;
use Acme\Models\Batch;
use Acme\Models\Consignment;

/**
 * Class Dispatcher
 *
 * This class are responsible to dispatch consignments to the right courier dispatcher. Allow us easily add dispatchers
 * only adding a new class and adding it to the dispatchers array.
 * In more complex systems, this could be a service that would be responsible for dispatching consignments.
 * The dispatchers should be injected into the factory, but for the sake of simplicity, they are hardcoded.
 */
class Dispatcher
{
    /** @var array<ConsignmentDispatcherInterface> */
    private array $dispatchers;

    public function __construct()
    {
        $this->dispatchers = [
            CouriersEnum::ROYAL_MAIL->value => new RoyalMailConsignmentDispatcher(),
            CouriersEnum::DHL->value => new DhlConsignmentDispatcher(),
        ];
    }

    public function dispatch(Batch $batch): void
    {
        foreach ($this->dispatchers as $courier => $dispatcher) {
            $consignments = array_filter(
                array: $batch->getConsignments(),
                callback: fn(Consignment $consignment) => $consignment->getCourier() === CouriersEnum::tryFrom($courier)
            );

            if (!$consignments) {
                continue;
            }

            $dispatcher->dispatch($consignments);
        }
    }
}