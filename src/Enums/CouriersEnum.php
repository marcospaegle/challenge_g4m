<?php

/**
 * All Couriers used by Gear4Music should be registered somewhere in the system
 * Since we don't use any DB, I used this enum to define the couriers
 *
 */

declare(strict_types=1);

namespace Acme\Enums;

enum CouriersEnum: string
{
    case ROYAL_MAIL = 'RoyalMail';
    case DHL = 'DHL';
}
