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

namespace ACedraz\CustomerSupport\Model;

use ACedraz\CustomerSupport\Api\SystemInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class System
 */
class System extends AbstractSystem implements SystemInterface
{
    /**
     * @return bool
     */
    public function getExtensionEnable(): bool
    {
        return (bool) $this->getValue(Config::CUSTOMER_SUPPORT_SECTION_CONFIGURATION_GROUP_ENABLE_FIELD, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return bool
     */
    public function getLogEnable(): bool
    {
        return (bool) $this->getValue(Config::CUSTOMER_SUPPORT_SECTION_CONFIGURATION_GROUP_ENABLE_LOG_FIELD, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return string
     */
    public function getLogName(): string
    {
        return (string) $this->getValue(Config::CUSTOMER_SUPPORT_SECTION_CONFIGURATION_GROUP_LOG_NAME_FIELD, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return bool
     */
    public function getRemoveEmptyChar(): bool
    {
        return (bool) $this->getValue(Config::CUSTOMER_SUPPORT_SECTION_REGISTER_GROUP_VALIDATE_EMPTY_CHARACTERS_IN_FIRST_NAME_FIELD, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return bool
     */
    public function getSendEmailCustomerSupport(): bool
    {
        return (bool) $this->getValue(Config::CUSTOMER_SECTION_CREATE_ACCOUNT_GROUP_ENABLE_CUSTOMER_SUPPORT_FIELD, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return string
     */
    public function getTemplateCustomerSupport(): string
    {
        return (string) $this->getValue(Config::CUSTOMER_SECTION_CREATE_ACCOUNT_GROUP_TEMPLATE_CUSTOMER_SUPPORT_FIELD, ScopeInterface::SCOPE_STORE);
    }
}
