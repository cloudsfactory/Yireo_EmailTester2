<?php
/**
 * EmailTester2 plugin for Magento
 *
 * @package     Yireo_EmailTester2
 * @author      Yireo (https://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (https://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

namespace Yireo\EmailTester2\Block\Adminhtml;

use \Magento\Backend\Block\Template;

class Overview extends Template
{
    /**
     * @var \Magento\Backend\Block\Widget\Button\ButtonList
     */
    protected $buttonList;

    /**
     * @var \Magento\Backend\Block\Widget\Button\ToolbarInterface
     */
    protected $toolbar;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Block\Widget\Button\ButtonList $buttonList
     * @param \Magento\Backend\Block\Widget\Button\ToolbarInterface $toolbar
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Block\Widget\Button\ButtonList $buttonList,
        \Magento\Backend\Block\Widget\Button\ToolbarInterface $toolbar,
        array $data = []
    ) {
        $this->buttonList = $buttonList;
        $this->toolbar = $toolbar;
        parent::__construct($context, $data);
    }

    /**
     * Create add button and grid blocks
     *
     * @return \Magento\Framework\View\Element\AbstractBlock
     */
    protected function _prepareLayout()
    {
        $this->buttonList->add(
            'send',
            [
                'label' => __('Send Email'),
                'onclick' => "window.location='" . $this->getSendUrl() . "'",
                'class' => 'send primary'
            ]
        );

        $this->buttonList->add(
            'preview',
            [
                'label' => __('Preview Email'),
                'onclick' => "window.location='" . $this->getPreviewUrl() . "'",
                'class' => 'preview primary'
            ]
        );

        $this->toolbar->pushButtons($this, $this->buttonList);

        $this->addChild('form', 'Yireo\EmailTester2\Block\Adminhtml\Overview\Form');

        return parent::_prepareLayout();
    }

    /**
     * Return the URL to send the mail
     *
     * @return string
     */
    public function getSendUrl()
    {
        return $this->getUrl('*/*/send');
    }

    /**
     * Return the URL to output the mail
     *
     * @return string
     */
    public function getPreviewUrl()
    {
        return $this->getUrl('*/*/preview');
    }

    /**
     * Return form block HTML
     *
     * @return string
     */
    public function getFormHtml()
    {
        return $this->getChildHtml('form');
    }

    /**
     * {@inheritdoc}
     */
    public function canRender(\Magento\Backend\Block\Widget\Button\Item $item)
    {
        return !$item->isDeleted();
    }
}
