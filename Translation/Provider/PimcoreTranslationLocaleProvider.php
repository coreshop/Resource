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

namespace CoreShop\Component\Resource\Translation\Provider;

use Pimcore\Tool;

final class PimcoreTranslationLocaleProvider implements TranslationLocaleProviderInterface
{
    public function getDefinedLocalesCodes(): array
    {
        return Tool::getValidLanguages();
    }

    public function getDefaultLocaleCode(): string
    {
        return Tool::getDefaultLanguage();
    }
}
