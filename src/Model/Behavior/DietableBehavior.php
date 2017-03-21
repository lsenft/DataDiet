<?php
namespace Lsenft\DataDiet\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Query;
use Cake\Event\Event;
use ArrayObject;
use Cake\Utility\Hash;

class DietableBehavior extends Behavior
{
    protected $config;
    
    public function initialize(array $config)
    {
        $this->config = $config;
        
    }
    
    //public function beforeFind(Event $event, Query $query, ArrayObject $options, boolean $primary) {
    public function beforeFind(Event $event, Query $query, ArrayObject $options, $primary)
    {
        // Authenticated user group_id exists
        if (empty($options['diet_auth']['group_id'])) {
            return;
        }
                
        // Does a rule exist for this group
        if (empty($this->config[(string)$options['diet_auth']['group_id']])) {
            return;
        }
        
        $options = Hash::merge($options, $this->config[(string)$options['diet_auth']['group_id']]);
        $query->bind('userId', $options['diet_auth']['group_id'])->bind('groupId', $options['diet_auth']['group_id']);
         // array merge $options $this->config[mygroup]
         // // bind user id and group vars
       // }
        
    }
}