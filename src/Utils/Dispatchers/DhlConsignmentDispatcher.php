<?php

declare(strict_types=1);

namespace Acme\Utils\Dispatchers;

use Acme\Models\Consignment;

/**
 * Class DhlConsignmentDispatcher
 *
 * This class are responsible to send consignments to DHL. We can dispatch it by email, ftp, or any other way
 * the courier allow us to do.
 */
class DhlConsignmentDispatcher implements ConsignmentDispatcherInterface
{
    /**
     * @param array<Consignment> $consignments
     */
    public function dispatch(array $consignments): void
    {
        $ids = array_map(
            callback: fn (Consignment $consignment) => $consignment->getId(),
            array: $consignments
        );

        printf(">>> Dispatching consignments to DHL. ID's %s\n", implode(', ', $ids));
    }
}