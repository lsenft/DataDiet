<?php
namespace Lsenft\DataDiet\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Query;
use Cake\Event\Event;
use ArrayObject;
use Cake\Utility\Hash;
use Cake\Utility\Inflector;

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
        
        $modelOptions = $this->config[(string)$options['diet_auth']['group_id']];
        
       
         
        
        // Apply he options from the model to fields made available by auth.
        $query->applyOptions($modelOptions['query']);
        
         if (!empty($modelOptions['bindings'])) {
            foreach($modelOptions['bindings'] as $binding) {
                $fieldName = Inflector::underscore(preg_replace('/:dd/', '', $binding));
                $query->bind($binding, $options['diet_auth'][$fieldName]);
            }
        }
    }
}