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

namespace Sylius\Component\Shipping\Resolver;

use Sylius\Component\Shipping\Checker\Eligibility\ShippingMethodEligibilityCheckerInterface;
use Sylius\Component\Shipping\Model\ShippingSubjectInterface;
use Sylius\Component\Shipping\Repository\ShippingMethodRepositoryInterface;

final class ShippingMethodsResolver implements ShippingMethodsResolverInterface
{
    public function __construct(
        private ShippingMethodRepositoryInterface $shippingMethodRepository,
        private ShippingMethodEligibilityCheckerInterface $eligibilityChecker,
    ) {
    }

    public function getSupportedMethods(ShippingSubjectInterface $subject): array
    {
        $methods = [];

        foreach ($this->shippingMethodRepository->findEnabledWithRules() as $shippingMethod) {
            if ($this->eligibilityChecker->isEligible($subject, $shippingMethod)) {
                $methods[] = $shippingMethod;
            }
        }

        return $methods;
    }

    public function supports(ShippingSubjectInterface $subject): bool
    {
        return true;
    }
}
