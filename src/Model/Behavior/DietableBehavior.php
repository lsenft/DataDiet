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
    protected $auth;
    
    public function initialize(array $config)
    {
        $this->config = $config;
        
        if (!empty($_SESSION['Auth'])) {
            $this->auth = $_SESSION['Auth'];
        }
    }
    
    //public function beforeFind(Event $event, Query $query, ArrayObject $options, boolean $primary) {
    public function beforeFind(Event $event, Query $query, ArrayObject $options, $primary)
    {
        // Authenticated user group_id exists
        if (empty($this->auth) || empty($this->auth['Group']['identifier'])) {
            return;
        }
                        
        // Does a rule exist for this group
        if (empty($this->config[$this->auth['Group']['identifier']])) {
            return;
        }
        
        $modelOptions = $this->config[$this->auth['Group']['identifier']];

        if (!empty($modelOptions['bindings'])) {
            foreach($modelOptions['bindings'] as $binding) {
                $fieldName = explode('.',  preg_replace('/:dd/', '', $binding));
                $fieldName[1] = Inflector::underscore($fieldName[1]);
                $binding = preg_replace('/\./', '',$binding);
                $modelOptions['query'] = $this->rec_array_replace($binding, $this->auth[$fieldName[0]][$fieldName[1]],$modelOptions['query']);
            }
        }        
        
        // Apply he options from the model to fields made available by auth.
        $query->applyOptions($modelOptions['query']);
    }
    
    protected function rec_array_replace ($find, $replace, $array)
    {
        if (! is_array($array)) {
            return str_replace($find, $replace, $array);
        }

        $newArray = array();

        foreach ($array as $key => $value) {
            $newArray[$key] = $this->rec_array_replace($find, $replace, $value);
        }

        return $newArray;
    }
}