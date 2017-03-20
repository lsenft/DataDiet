<?php
namespace Lsenft\DataDiet\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Query;
use Cake\Event\Event;


class DietableBehavior extends Behavior
{
    protected $config;
    
    public function initialize(array $config)
    {
        $this->config = $config;
        
    }
    
    //public function beforeFind(Event $event, Query $query, ArrayObject $options, boolean $primary) {
    public function beforeFind(Event $event, Query $query, \ArrayObject $options, $primary)
    {
        var_dump($this->config);
       // die();
        
    }
}