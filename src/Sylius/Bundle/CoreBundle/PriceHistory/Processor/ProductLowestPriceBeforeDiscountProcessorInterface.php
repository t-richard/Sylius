<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Sylius Sp. z o.o.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Sylius\Bundle\CoreBundle\PriceHistory\Processor;

use Sylius\Component\Core\Model\ChannelPricingInterface;

interface ProductLowestPriceBeforeDiscountProcessorInterface
{
    public function process(ChannelPricingInterface $channelPricing): void;
}