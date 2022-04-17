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

namespace ACedraz\CustomerSupport\Plugin\Customer\Api;

use ACedraz\CustomerSupport\Api\EmailSenderInterface;
use ACedraz\CustomerSupport\Api\TreatCustomerDataInterface;
use Magento\Customer\Api\Data\CustomerInterface;

/**
 * Class AccountManagementInterface
 */
class AccountManagementInterface
{
    /** @var TreatCustomerDataInterface */
    private TreatCustomerDataInterface $treatCustomerData;

    /** @var EmailSenderInterface */
    private EmailSenderInterface $emailSender;

    /**
     * @param TreatCustomerDataInterface $treatCustomerData
     * @param EmailSenderInterface $emailSender
     */
    public function __construct(
        TreatCustomerDataInterface $treatCustomerData,
        EmailSenderInterface $emailSender
    ) {
        $this->treatCustomerData = $treatCustomerData;
        $this->emailSender = $emailSender;
    }

    /**
     * @param \Magento\Customer\Api\AccountManagementInterface $subject
     * @param CustomerInterface $customer
     * @param $password
     * @param string $redirectUrl
     * @return array
     */
    public function beforeCreateAccount(
        \Magento\Customer\Api\AccountManagementInterface $subject,
        CustomerInterface $customer,
        $password = null,
        $redirectUrl = ''
    ): array
    {
        $customer = $this->treatCustomerData->treat($customer);
        return [$customer, $password, $redirectUrl];
    }

    /**
     * @param \Magento\Customer\Api\AccountManagementInterface $subject
     * @param CustomerInterface $result
     * @param CustomerInterface $customer
     * @param $password
     * @param $redirectUrl
     * @return mixed
     */
    public function afterCreateAccount(
        \Magento\Customer\Api\AccountManagementInterface $subject,
        CustomerInterface $result,
        CustomerInterface $customer,
        $password = null,
        $redirectUrl = ''
    ) {
        $this->emailSender->customerSupport($result);
        return $result;
    }
}
