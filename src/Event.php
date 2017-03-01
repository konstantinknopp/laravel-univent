<?php

namespace Unikat\Univent;

abstract class Event
{
    
    /**
     * Holds the event listeners
     * @var array
     */
    protected $listeners = [];
    
    /**
     * @param string $hook      Hook name
     * @param mixed  $callback  Function to execute
     * @param int    $priority  Priority of the action
     * @param int    $arguments Number of arguments to accept
     */
    public function listen($hook, $callback, $priority = 20, $arguments = 1)
    {
        $i              = 0;
        $uniquePriority = $priority;
        do {
            if (isset($this->listeners[$this->listeners[$uniquePriority][$hook]])) {
                $i += 0.1;
                $uniquePriority = $priority + $i;
            }
        } while (isset($this->listeners[$uniquePriority][$hook]));
        $this->listeners[$uniquePriority][$hook] = compact('callback', 'arguments');
    }
    
    /**
     * Gets a sorted list of all listeners
     * @return array
     */
    public function getListeners()
    {
        uksort($this->listeners, function ($a, $b) {
            return strnatcmp($a, $b);
        });
        
        return $this->listeners;
    }
    
    /**
     * Gets the function
     *
     * @param  mixed $callback Callback
     *
     * @return mixed          A Closure, an array if "class@method" or a string if "function_name"
     * @throws \Exception
     */
    protected function getFunction($callback)
    {
        if (is_string($callback) && strpos($callback, '@')) {
            $callback = explode('@', $callback);
            
            return [app('\\' . $callback[0]), $callback[1]];
        } elseif (is_callable($callback)) {
            return $callback;
        } else {
            throw new \Exception('$callback is not a callable');
        }
    }
    
    abstract function fire($action, $args);
}
