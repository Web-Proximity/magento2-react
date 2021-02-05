<?php
/**
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this module to newer
 * versions in the future.
 *
 * @category  Smile
 * @package   Smile\React
 * @author    Romain Ruaud <romain.ruaud@smile.fr>
 * @copyright 2021 Smile
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Smile\React\Block;

use Magento\Framework\View\Element\Template;

/**
 * Custom implementation of the navigation block to apply facet coverage rate.
 *
 * @category Smile
 * @package  Smile\React
 * @author   Romain Ruaud <romain.ruaud@smile.fr>
 */
class Script extends Template
{
    /**
     * Default location of the file.
     */
    const DEFAULT_URL = 'js/react.bundle.js';

    /**
     * Get Script URL with a format that is compliant with pub/static/versionX/file.js
     * To ensure the file folllows a proper caching and variation policy.
     *
     * @return string|string[]
     */
    public function getScriptUrl()
    {
        // https://website.com/pub/static/version1612185290/frontend/theme/default/locale_LOCALE/js/react.bundle.js
        $fileUrl = $this->getViewFileUrl('js/react.bundle.js');

        $pattern = "/\/pub\/static\/version[0-9]*([\s\S]+?)\/js\/react.bundle.js/";
        preg_match($pattern, $fileUrl, $matches);

        if (isset($matches[1]) && $matches[1] !== '') {
            return str_replace($matches[1], '', $fileUrl);
        }

        return '/' . self::DEFAULT_URL;
    }
}
