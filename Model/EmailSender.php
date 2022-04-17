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

use ACedraz\CustomerSupport\Api\EmailSenderInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Model\EmailNotification;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\MailException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class EmailSender
 */
class EmailSender extends AbstractEmailSender implements EmailSenderInterface
{
    /**
     * @param CustomerInterface $customer
     * @param null $defaultStoreId
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function getWebsiteStoreId(CustomerInterface $customer, $defaultStoreId = null)
    {
        if ($customer->getWebsiteId() != 0 && empty($defaultStoreId)) {
            $storeIds = $this->_storeManager->getWebsite($customer->getWebsiteId())->getStoreIds();
            $defaultStoreId = reset($storeIds);
        }
        return $defaultStoreId;
    }

    /**
     * @param CustomerInterface $customer
     */
    public function customerSupport(CustomerInterface $customer)
    {
        if ((!$this->system->getExtensionEnable() || !$this->system->getSendEmailCustomerSupport()) && $this->system->getLogEnable()) {
            $this->logger->addError('Extension or email sender functionality disabled.');
        }
        if ($this->system->getLogEnable()) {
            $message = $this->getCurrentRegister() . PHP_EOL .
            'Customer Email: ' . $customer->getEmail() . PHP_EOL .
            'Customer First Name: ' . $customer->getFirstname() . PHP_EOL .
            'Customer Last Name: ' . $customer->getLastname();
            $this->logger->addInfo($message);
        }
        if ($this->system->getExtensionEnable() && $this->system->getSendEmailCustomerSupport()) {
            try {
                $storeId = $this->getWebsiteStoreId($customer);
                $store = $this->_storeManager->getStore($customer->getStoreId());
                $this->sendEmailTemplate(
                    $this->system->getTemplateCustomerSupport(),
                    EmailNotification::XML_PATH_REGISTER_EMAIL_IDENTITY,
                    ['customer' => $this->getFullCustomerObject($customer), 'store' => $store],
                    $storeId
                );
            } catch (MailException|NoSuchEntityException|LocalizedException $e) {
                if ($this->system->getLogEnable()) {
                    $this->logger->addError($e->getMessage());
                }
            }
        }
    }
}
