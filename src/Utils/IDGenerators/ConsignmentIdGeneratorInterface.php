<?php

declare(strict_types=1);

namespace Acme\Utils\IDGenerators;

/**
 * Consignment ID generator interface, a contract to define how to generate consignment IDs.
 * Since each courier has one way to generate consignment IDs, we can define a contract to make sure that
 * each courier's consignment ID generator implements the same method.
 */
interface ConsignmentIdGeneratorInterface
{
    public function generate(): string;
}