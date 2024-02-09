<?php

declare(strict_types=1);

namespace Acme\Utils\IDGenerators;

use Acme\Enums\CouriersEnum;
use InvalidArgumentException;

/**
 * Class ConsignmentIdFactory
 *
 * This factory is responsible for generating new consignment IDs based on the courier.
 * In more complex systems, this could be a service that would be responsible for generating consignment IDs.
 * The generators should be injected into the factory, but for the sake of simplicity, they are hardcoded.
 */
class ConsignmentIdFactory
{
    /**
     * @var array<ConsignmentIdGeneratorInterface>
     */
    private array $generators;

    public function __construct()
    {
        $this->generators = [
            CouriersEnum::ROYAL_MAIL->value => new RoyalMailConsignmentIdGenerator(),
            CouriersEnum::DHL->value => new DhlConsignmentIdGenerator()
        ];
    }

    public function generateNewId(CouriersEnum $courier): string
    {
        if (isset($this->generators[$courier->value])) {
            return $this->generators[$courier->value]->generate();
        }

        throw new InvalidArgumentException('Invalid courier');
    }
}