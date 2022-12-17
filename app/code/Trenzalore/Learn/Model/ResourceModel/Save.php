<?php

declare(strict_types=1);

namespace Trenzalore\Learn\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Save extends AbstractDb
{

    const  TABLE_NAME = 'trenzalore_learn_knockout_save';

    const TABLE_ID_NAME = 'entity_id';

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, self::TABLE_ID_NAME);
    }
}
