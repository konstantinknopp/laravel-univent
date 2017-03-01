<?php

namespace Unikat\Univent;

class Events
{
    
    /**
     * Holds all registered actions
     * @var Action
     */
    protected $action;
    
    /**
     * Events constructor.
     */
    public function __construct()
    {
        $this->action = new Action();
    }
    
    /**
     * Get the action instance
     * @return Action
     */
    public function getAction()
    {
        return $this->action;
    }
    
    /**
     * Add an action
     *
     * @param string $hook      Hook name
     * @param mixed  $callback  Function to execute
     * @param int    $priority  Priority of the action
     * @param int    $arguments Number of arguments to accept
     */
    public function addAction($hook, $callback, $priority = 20, $arguments = 1)
    {
        $this->action->listen($hook, $callback, $priority, $arguments);
    }
    
    /**
     * Set a new action
     *
     * Actions never return anything. It is merely a way of executing code at a specific point in your code.
     *
     * You can add as many parameters as you'd like.
     */
    public function action()
    {
        $args = func_get_args();
        $hook = $args[0];
        unset($args[0]);
        $args = array_values($args);
        $this->action->fire($hook, $args);
    }
}