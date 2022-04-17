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
use ACedraz\CustomerSupport\Logger\Logger;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Helper\View as CustomerViewHelper;
use Magento\Customer\Model\CustomerRegistry;
use Magento\Customer\Model\Data\CustomerSecure;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Mail\Template\SenderResolverInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Store\Model\App\Emulation;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Abstract Class System
 */
abstract class AbstractEmailSender
{
    /** @var SystemInterface */
    protected SystemInterface $system;

    /** @var string|null */
    protected ?string $receiverName = null;

    /** @var string|null */
    protected ?string $receiverEmail = null;

    /** @var ScopeConfigInterface */
    private ScopeConfigInterface $_scopeConfig;

    /** @var SenderResolverInterface */
    private $_senderResolver;

    /** @var TransportBuilder */
    private TransportBuilder $_transportBuilder;

    /** @var Emulation */
    private Emulation $_emulation;

    /** @var CustomerRegistry */
    private CustomerRegistry $_customerRegistry;

    /** @var DataObjectProcessor */
    private DataObjectProcessor $_dataProcessor;

    /** @var CustomerViewHelper */
    private CustomerViewHelper $_customerViewHelper;

    /** @var StoreManagerInterface */
    protected StoreManagerInterface $_storeManager;

    /** @var Logger */
    protected Logger $logger;

    /** @var DateTime */
    private DateTime $_date;

    /**
     * @param DateTime $_date
     * @param Logger $logger
     * @param StoreManagerInterface $_storeManager
     * @param CustomerViewHelper $_customerViewHelper
     * @param DataObjectProcessor $_dataProcessor
     * @param CustomerRegistry $customerRegistry
     * @param SystemInterface $system
     * @param ScopeConfigInterface $_scopeConfig
     * @param TransportBuilder $_transportBuilder
     * @param SenderResolverInterface|null $senderResolver
     * @param Emulation|null $emulation
     */
    public function __construct(
        DateTime $_date,
        Logger $logger,
        StoreManagerInterface $_storeManager,
        CustomerViewHelper $_customerViewHelper,
        DataObjectProcessor $_dataProcessor,
        CustomerRegistry $customerRegistry,
        SystemInterface $system,
        ScopeConfigInterface $_scopeConfig,
        TransportBuilder $_transportBuilder,
        SenderResolverInterface $senderResolver = null,
        Emulation $emulation = null
    ) {
        $this->system = $system;
        $this->_scopeConfig = $_scopeConfig;
        $this->_senderResolver = $senderResolver ?? ObjectManager::getInstance()->get(SenderResolverInterface::class);
        $this->_transportBuilder = $_transportBuilder;
        $this->_emulation = $emulation ?? ObjectManager::getInstance()->get(Emulation::class);
        $this->_customerRegistry = $customerRegistry;
        $this->_dataProcessor = $_dataProcessor;
        $this->_customerViewHelper = $_customerViewHelper;
        $this->_storeManager = $_storeManager;
        $this->logger = $logger;
        $this->_date = $_date;
    }

    /**
     * @param $templateId
     * @param $sender
     * @param $templateParams
     * @param $storeId
     * @param $emailTo
     * @param $nameTo
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\MailException
     */
    protected function sendEmailTemplate(
        $templateId,
        $sender,
        $templateParams = [],
        $storeId = null
    ) {
        /** @var array $from */
        $from = $this->_senderResolver->resolve(
            $this->_scopeConfig->getValue($sender, ScopeInterface::SCOPE_STORE, $storeId),
            $storeId
        );
        $transport = $this->_transportBuilder->setTemplateIdentifier($templateId)
            ->setTemplateOptions(['area' => 'frontend', 'store' => $storeId])
            ->setTemplateVars($templateParams)
            ->setFrom($from)
            ->addTo($this->getReceiverInfo()['email'], $this->getReceiverInfo()['name'])
            ->getTransport();
        $this->_emulation->startEnvironmentEmulation($storeId, \Magento\Framework\App\Area::AREA_FRONTEND);
        $transport->sendMessage();
        $this->_emulation->stopEnvironmentEmulation();
    }

    /**
     * Create an object with data merged from Customer and CustomerSecure
     *
     * @param CustomerInterface $customer
     * @return CustomerSecure
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    protected function getFullCustomerObject(CustomerInterface $customer): CustomerSecure
    {
        $mergedCustomerData = $this->_customerRegistry->retrieveSecureData($customer->getId());
        $customerData = $this->_dataProcessor
            ->buildOutputDataArray($customer, CustomerInterface::class);
        $mergedCustomerData->addData($customerData);
        $mergedCustomerData->setData('name', $this->_customerViewHelper->getCustomerName($customer));
        $mergedCustomerData->setData('firstname', $customer->getFirstname());
        $mergedCustomerData->setData('lastname', $customer->getLastname());
        return $mergedCustomerData;
    }

    /**
     * @return array
     */
    protected function getReceiverInfo(): array
    {
        return [
            'name' => $this->receiverName ?? $this->_scopeConfig->getValue('trans_email/ident_support/name', ScopeInterface::SCOPE_STORE),
            'email' => $this->receiverEmail ?? $this->_scopeConfig->getValue('trans_email/ident_support/email', ScopeInterface::SCOPE_STORE)
        ];
    }

    /**
     * @return string
     */
    protected function getCurrentRegister(): string
    {
        return '[' . $this->_date->gmtDate() . ']';
    }
}
