<?php
declare(strict_types=1);

namespace App\Enum;

/**
 * Defines the possible values for notification type.
 *
 * @package App\Enum
 * @author Ciprian Popescu <ciprian@dreamlabs.ro>
 */
final class NotificationTypeEnum
{
    const TYPE_GENERIC = 'generic';
    const TYPE_PRODUCT = 'product';
    const TYPE_WEATHER = 'weather';
}