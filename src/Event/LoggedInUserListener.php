<?php
namespace Lsenft\DataDiet\Event;

use ArrayObject;
use Cake\Controller\Component\AuthComponent;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\Event\EventListenerInterface;
/**
 * Class LoggedInUserListener
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 */
class LoggedInUserListener implements EventListenerInterface {
/**
 * @var AuthComponent
 */
    protected $_Auth;
/**
 * Constructor
 *
 * @param \Cake\Controller\Component\AuthComponent $Auth Authcomponent
 */
    public function __construct(AuthComponent $Auth) {
        $this->_Auth = $Auth;
    }
/**
 * {@inheritDoc}
 */
    public function implementedEvents() {
        return [
                'Model.beforeFind' => [
                        'callable' => 'beforeFind',
                        'priority' => -100
                ]
        ];
    }
    
    public function beforeFind(Event $event, Query $query, \ArrayObject $options, $primary) {
        if (empty($options['diet_auth'])) {
            $options['diet_auth'] = $this->_Auth->user();
        }
    }
}