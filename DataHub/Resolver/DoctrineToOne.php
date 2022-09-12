<?php

declare(strict_types=1);

/*
 * CoreShop
 *
 * This source file is available under two different licenses:
 *  - GNU General Public License version 3 (GPLv3)
 *  - CoreShop Commercial License (CCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @copyright  Copyright (c) CoreShop GmbH (https://www.coreshop.org)
 * @license    https://www.coreshop.org/license     GPLv3 and CCL
 *
 */

namespace CoreShop\Component\Resource\DataHub\Resolver;

use CoreShop\Component\Resource\DataHub\DoctrineProvider;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class DoctrineToOne
{
    public function __construct(
        private DoctrineProvider $typeProvider,
        private string $name,
        private string $graphName,
    ) {
    }

    /**
     * Generate the definition for the GraphQL field.
     */
    public function getDefinition(): array
    {
        $outputType = $this->typeProvider->getType($this->graphName);

        $args = [];

        // Create and return the definition array
        return [
            'name' => $this->name,
            'type' => $outputType,
            'args' => $args,
            'resolve' => function ($value, $args, $context, $info) {
                if (is_array($value)) {
                    return $value[$this->name];
                }

                if (method_exists($value, 'get')) {
                    return $value->get($this->name);
                }

                $propertyAccessor = new PropertyAccessor();

                return $propertyAccessor->getValue($value, $this->name);
            },
        ];
    }
}
