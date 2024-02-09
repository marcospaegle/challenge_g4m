<?php

declare(strict_types=1);

namespace Acme\Models;

use DateTimeImmutable;

/**
 * Class Batch
 *
 * This class represents a batch.
 *
 * @package Acme\Models
 * @property string $id
 * @property DateTimeImmutable|null $openedAt
 * @property DateTimeImmutable|null $closedAt
 * @property array<Consignment> $consignments
 *
 */
class Batch
{
    private string $id;
    private ?DateTimeImmutable $openedAt = null;
    private ?DateTimeImmutable $closedAt = null;

    /** @var array<Consignment> */
    private array $consignments = [];

    public function __construct()
    {
        $this->id = 'BATCH-' . random_int(1000, 9999);
    }

    public function start(): Batch
    {
        if ($this->openedAt) {
            throw new \Exception('Batch already started');
        }

        $this->openedAt = new DateTimeImmutable();

        return $this;
    }

    public function close(): Batch
    {
        if (!$this->openedAt) {
            throw new \Exception('Batch not started');
        }

        if ($this->closedAt) {
            throw new \Exception('Batch already closed');
        }

        $this->closedAt = new DateTimeImmutable();

        return $this;
    }

    public function addConsignment(Consignment $consignment): Batch
    {
        $this->consignments[] = $consignment;

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getOpenedAt(): ?DateTimeImmutable
    {
        return $this->openedAt;
    }

    public function getClosedAt(): ?DateTimeImmutable
    {
        return $this->closedAt;
    }

    public function getConsignments(): array
    {
        return $this->consignments;
    }
}