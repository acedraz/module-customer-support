<?php
/**
 * ACedraz
 *
 * @category  ACedraz
 * @package   CustomerSupport
 * @version   1.0.1
 * @author    Aislan Cedraz <aislan.cedraz@gmail.com.br>
 */

declare(strict_types=1);

namespace ACedraz\CustomerSupport\Api;

/**
 * Interface SystemInterface
 */
interface SystemInterface
{
    /**
     * @return bool
     */
    public function getExtensionEnable(): bool;

    /**
     * @return bool
     */
    public function getLogEnable(): bool;

    /**
     * @return string
     */
    public function getLogName(): string;

    /**
     * @return bool
     */
    public function getRemoveEmptyChar(): bool;

    /**
     * @return bool
     */
    public function getSendEmailCustomerSupport(): bool;

    /**
     * @return string
     */
    public function getTemplateCustomerSupport(): string;
}
