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

namespace ACedraz\CustomerSupport\Block\Adminhtml\Customer\CustomerSupport;

use Magento\Framework\UrlInterface;
use Magento\Config\Model\Config\CommentInterface;

/**
 * Class Comment
 */
class Comment implements CommentInterface
{
    /** @var UrlInterface */
    protected UrlInterface $_urlInterface;

    /**
     * @param UrlInterface $_urlInterface
     */
    public function __construct(
        UrlInterface $_urlInterface
    ) {
        $this->_urlInterface = $_urlInterface;
    }

    /**
     * @param $elementValue
     * @return string
     */
    public function getCommentText($elementValue)
    {
        $url = $this->_urlInterface->getUrl('adminhtml/system_config/edit/section/trans_email');
        return __('Configure email addresses in: <a href="%1#trans_email_ident_support-link" target="_blank">Customer Support</a>.',$url);
    }
}
