<?php
namespace Lsenft\DataDiet\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Query;
use Cake\Event\Event;

class DietableBehavior extends Behavior
{
    public function initialize(array $config)
    {
        // Some initialization code here
        //die('test');
        
    }
    
    //public function beforeFind(Event $event, Query $query, ArrayObject $options, boolean $primary) {
    public function beforeFind(Event $event, Query $query, \ArrayObject $options, $primary)
    {
        var_dump($options);
       // die();
        
    }
}