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
        // Authenticated user group_id exists
        if (empty($options['diet_auth']['group_id'])) {
            return;
        }
                
        // Does a rule exist for this group
        if (!empty($this->config[(string)$options['diet_auth']['group_id']])) {
            var_dump($this->config[(string)$options['diet_auth']['group_id']]);
        }
         // array merge $options $this->config[mygroup]
         // // bind user id and group vars
       // }
        
    }
}