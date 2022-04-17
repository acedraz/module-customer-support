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
 * Interface TreatCustomerDataInterface
 */
interface TreatCustomerDataInterface
{
    const FIRSTNAME = 'firstname';

    /**
     * @param CustomerInterface $customer
     * @param string $type
     * @return CustomerInterface
     */
    public function treat(CustomerInterface $customer, string $type = self::FIRSTNAME): CustomerInterface;
}
