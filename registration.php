<?php
/**
 * ACedraz
 *
 * @category  ACedraz
 * @package   CustomerSupport
 * @version   1.0.0
 * @author    Aislan Cedraz <aislan.cedraz@gmail.com.br>
 */

declare(strict_types=1);

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'ACedraz_CustomerSupport',
    __DIR__
);
