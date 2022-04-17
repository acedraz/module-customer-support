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
use ACedraz\CustomerSupport\Api\TreatCustomerDataInterface;
use ACedraz\CustomerSupport\Logger\Logger;
use Magento\Customer\Api\Data\CustomerInterface;

/**
 * Class TreatCustomerData
 */
class TreatCustomerData implements TreatCustomerDataInterface
{
    /** @var SystemInterface */
    private SystemInterface $system;

    /** @var Logger */
    private Logger $logger;

    /**
     * @param SystemInterface $system
     * @param Logger $logger
     */
    public function __construct(
        SystemInterface $system,
        Logger $logger
    ) {
        $this->system = $system;
        $this->logger = $logger;
    }

    /**
     * @param CustomerInterface $customer
     * @param string $type
     * @return CustomerInterface
     */
    public function treat(CustomerInterface $customer, string $type = self::FIRSTNAME): CustomerInterface
    {
        if ((!$this->system->getExtensionEnable() || !$this->system->getRemoveEmptyChar()) && $this->system->getLogEnable()) {
            $this->logger->addError('Extension or treating functionality disabled.');
        }
        if ($this->system->getExtensionEnable() && $this->system->getRemoveEmptyChar()) {
            switch ($type) {
                case self::FIRSTNAME;
                    $customer->setFirstname($this->treatFirstName($customer->getFirstname()));
                    break;
            }
        }
        return $customer;
    }

    /**
     * @param string $firstName
     * @return array|string|string[]
     */
    protected function treatFirstName(string $firstName)
    {
        return $this->removeEmptyChar($firstName);
    }

    /**
     * @param string $sentence
     * @return array|string|string[]
     */
    private function removeEmptyChar(string $sentence)
    {
        return str_replace(' ', '', $sentence);
    }
}
