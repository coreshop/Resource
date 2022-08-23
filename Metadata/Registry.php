<?php
/**
 * CoreShop.
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md and gpl-3.0.txt
 * files that are distributed with this source code.
 *
 * @copyright  Copyright (c) CoreShop GmbH (https://www.coreshop.org)
 * @license    https://www.coreshop.org/license     GPLv3 and CCL
 */

declare(strict_types=1);

namespace CoreShop\Component\Resource\Metadata;

final class Registry implements RegistryInterface
{
    private array $metadata = [];

    public function getAll(): array
    {
        return $this->metadata;
    }

    public function get($alias): MetadataInterface
    {
        if (!array_key_exists($alias, $this->metadata)) {
            throw new \InvalidArgumentException(sprintf('Model "%s" does not exist.', $alias));
        }

        return $this->metadata[$alias];
    }

    public function getByClass($className): MetadataInterface
    {
        foreach ($this->metadata as $metadata) {
            if ($className === $metadata->getClass('model')) {
                return $metadata;
            }
        }

        throw new \InvalidArgumentException(sprintf('Model with class "%s" does not exist.', $className));
    }

    public function add(MetadataInterface $metadata): void
    {
        $this->metadata[$metadata->getAlias()] = $metadata;
    }

    public function addFromAliasAndConfiguration($alias, array $configuration): void
    {
        $this->add(Metadata::fromAliasAndConfiguration($alias, $configuration));
    }
}
