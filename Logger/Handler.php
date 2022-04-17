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

namespace ACedraz\CustomerSupport\Logger;

use ACedraz\CustomerSupport\Api\SystemInterface;
use Magento\Framework\Filesystem\DriverInterface;
use Magento\Framework\Logger\Handler\Base;
use Monolog\Logger;

/**
 * Class Handler
 */
class Handler extends Base
{
    /** @var string */
    const DIRECTORY_VAR_LOG = DIRECTORY_SEPARATOR . 'var' . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR;

    /**
     * @param SystemInterface $system
     * @param DriverInterface $filesystem
     * @param $filePath
     * @param $fileName
     * @throws \Exception
     */
    public function __construct(
        SystemInterface $system,
        DriverInterface $filesystem,
        $filePath = null,
        $fileName = null
    ) {
        parent::__construct(
            $filesystem,
            $filePath,
            $fileName ?? self::DIRECTORY_VAR_LOG . $system->getLogName()
        );
    }

    /**
     * Logging level
     * @var int
     */
    protected $loggerType = Logger::INFO;
}
