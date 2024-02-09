<?php

declare(strict_types=1);

namespace Acme\Models;

use Acme\Enums\CouriersEnum;

/**
 * Class Consignment
 *
 * This class represents a consignment. In future implementations we should consider adding the orders that are
 * part of the consignment.
 *
 * @package Acme\Models
 * @property string $id
 * @property CouriersEnum $courier
 */
class Consignment
{
    public function __construct(
        private string $id,
        private CouriersEnum $courier
    )
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCourier(): CouriersEnum
    {
        return $this->courier;
    }
}