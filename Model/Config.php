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

/**
 * Class Config
 */
class Config
{
    /** @var string */
    const CUSTOMER_SUPPORT_SECTION = 'customer_support';

    /** @var string */
    const CUSTOMER_SECTION = 'customer';

    /** @var string */
    const CONFIGURATION_GROUP = 'configuration';

    /** @var string */
    const CREATE_ACCOUNT_GROUP = 'create_account';

    /** @var string */
    const REGISTER_GROUP = 'register';

    /** @var string */
    const ENABLE_FIELD = 'enable';

    /** @var string */
    const ENABLE_LOG_FIELD = 'enable_log';

    /** @var string */
    const LOG_NAME_FIELD = 'log_name';

    /** @var string */
    const VALIDATE_EMPTY_CHARACTERS_IN_FIRST_NAME_FIELD = 'validate_empty_characters_in_first_name';

    /** @var string */
    const ENABLE_CUSTOMER_SUPPORT_FIELD = 'enable_customer_support';

    /** @var string */
    const TEMPLATE_CUSTOMER_SUPPORT_FIELD = 'template_customer_support';

    /** @var string */
    const CUSTOMER_SUPPORT_SECTION_CONFIGURATION_GROUP = self::CUSTOMER_SUPPORT_SECTION . DIRECTORY_SEPARATOR . self::CONFIGURATION_GROUP;

    /** @var string */
    const CUSTOMER_SUPPORT_SECTION_REGISTER_GROUP = self::CUSTOMER_SUPPORT_SECTION . DIRECTORY_SEPARATOR . self::REGISTER_GROUP;

    /** @var string */
    const CUSTOMER_SECTION_CREATE_ACCOUNT_GROUP = self::CUSTOMER_SECTION . DIRECTORY_SEPARATOR . self::CREATE_ACCOUNT_GROUP;

    /** @var string */
    const CUSTOMER_SUPPORT_SECTION_CONFIGURATION_GROUP_ENABLE_FIELD = self::CUSTOMER_SUPPORT_SECTION_CONFIGURATION_GROUP . DIRECTORY_SEPARATOR . self::ENABLE_FIELD;

    /** @var string */
    const CUSTOMER_SUPPORT_SECTION_CONFIGURATION_GROUP_ENABLE_LOG_FIELD = self::CUSTOMER_SUPPORT_SECTION_CONFIGURATION_GROUP . DIRECTORY_SEPARATOR . self::ENABLE_LOG_FIELD;

    /** @var string */
    const CUSTOMER_SUPPORT_SECTION_CONFIGURATION_GROUP_LOG_NAME_FIELD = self::CUSTOMER_SUPPORT_SECTION_CONFIGURATION_GROUP . DIRECTORY_SEPARATOR . self::LOG_NAME_FIELD;

    /** @var string */
    const CUSTOMER_SUPPORT_SECTION_REGISTER_GROUP_VALIDATE_EMPTY_CHARACTERS_IN_FIRST_NAME_FIELD = self::CUSTOMER_SUPPORT_SECTION_REGISTER_GROUP . DIRECTORY_SEPARATOR . self::VALIDATE_EMPTY_CHARACTERS_IN_FIRST_NAME_FIELD;

    /** @var string */
    const CUSTOMER_SECTION_CREATE_ACCOUNT_GROUP_ENABLE_CUSTOMER_SUPPORT_FIELD = self::CUSTOMER_SECTION_CREATE_ACCOUNT_GROUP . DIRECTORY_SEPARATOR . self::ENABLE_CUSTOMER_SUPPORT_FIELD;

    /** @var string */
    const CUSTOMER_SECTION_CREATE_ACCOUNT_GROUP_TEMPLATE_CUSTOMER_SUPPORT_FIELD = self::CUSTOMER_SECTION_CREATE_ACCOUNT_GROUP . DIRECTORY_SEPARATOR . self::TEMPLATE_CUSTOMER_SUPPORT_FIELD;
}
