<?php

declare(strict_types=1);

namespace Acme\Utils\Dispatchers;

use Acme\Models\Consignment;

/**
 * Consignment dispatcher interface, a contract to define how to dispatch the consignments ID to the couriers.
 * Since each courier has one way to receive the consignment IDs, we can define a contract to make sure that
 * each courier's dispatcher implements the same method.
 */
interface ConsignmentDispatcherInterface
{
    /**
     * @param array<Consignment> $consignments
     */
    public function dispatch(array $consignments): void;
}