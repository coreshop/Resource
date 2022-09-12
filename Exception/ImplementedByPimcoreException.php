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

namespace CoreShop\Component\Resource\Exception;

class ImplementedByPimcoreException extends \InvalidArgumentException
{
    public function __construct(
        $class,
        $property,
    ) {
        parent::__construct(
            sprintf(
                '%s of "%s" needs to be implemented by Pimcore.',
                $class,
                $property,
            ),
        );
    }
}
