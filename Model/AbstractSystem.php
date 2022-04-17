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

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;

/**
 * Abstract Class System
 */
abstract class AbstractSystem
{
    /** @var WriterInterface */
    private WriterInterface $configWriter;

    /** @var ScopeConfigInterface */
    private ScopeConfigInterface $scopeConfig;

    /**
     * SystemAbstract constructor.
     * @param WriterInterface $configWriter
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        WriterInterface $configWriter,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->configWriter = $configWriter;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param string $path
     * @param string $scopeType
     * @param null $scopeCode
     * @return mixed
     */
    protected function getValue(string $path, string $scopeType = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeCode = null)
    {
        return $this->scopeConfig->getValue(
            $path,
            $scopeType,
            $scopeCode
        );
    }

    /**
     * @param $path
     * @param $value
     * @param string $scope
     * @param int $scopeId
     */
    public function setValue($path, $value, string $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, int $scopeId = 0)
    {
        $this->configWriter->save( $path, $value, $scope, $scopeId);
    }
}
