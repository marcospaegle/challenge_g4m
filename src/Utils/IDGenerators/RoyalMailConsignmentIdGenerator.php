<?php

declare(strict_types=1);

namespace Acme\Utils\IDGenerators;

/**
 * Class RoyalMailConsignmentIdGenerator
 *
 * This class is responsible for generating consignment IDs for Royal Mail. Since the class implements the
 * ConsignmentIdGeneratorInterface, doesn't matter how the courier implements the consignment ID generation, we
 * retrieve and use it.
 */
class RoyalMailConsignmentIdGenerator implements ConsignmentIdGeneratorInterface
{
    public function generate(): string
    {
        return 'RM' . random_int(1000, 9999) . 'UK';
    }
}