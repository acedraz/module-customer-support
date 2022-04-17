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

use Magento\Customer\Api\Data\CustomerInterface;

/**
 * Interface EmailSenderInterface
 */
interface EmailSenderInterface
{
    const CUSTOMER_SUPPORT_SERVICE = 'customer_support';

    /**
     * @param CustomerInterface $customer
     */
    public function customerSupport(CustomerInterface $customer);
}
