<?php
class Order extends lmbActiveRecord
{
    const STATUS_NEW                 = 1;
    const STATUS_PROCESSED           = 2;
    const STATUS_FINISHED            = 3;

    protected $_has_many = array('lines' => array('field' => 'order_id','class' => 'OrderLine'));

    function createForCart($cart)
    {
        $order = new Order();
        $order->setStatus(Order :: STATUS_NEW);
        $order->setLines($cart->getItems());
        $order->setSumm($cart->getTotalSumm());
        $order->setDate(time());
        return $order;
    }

    function setStatus($value)
    {
        $statuses = $this->getStatusOptions();
        if(isset($statuses[$value]))
            $this->_setRaw('status', $value);
    }

    function getStatusName()
    {
        $statuses = $this->getStatusOptions();
        return $statuses[$this->getStatus()];
    }

    function getStatusOptions()
    {
        return array(
            self :: STATUS_NEW => 'new',
            self :: STATUS_PROCESSED => 'processed',
            self :: STATUS_FINISHED => 'finished'
        );
    }

    static function findForAdmin($params = array())
    {
        $criteria = new lmbSQLCriteria();

        if(isset($params['status']))
            $criteria->add(lmbSQLCriteria::equal('status', $params['status']));

        return Order :: find($criteria);
    }
}