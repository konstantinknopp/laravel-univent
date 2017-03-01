<?php

namespace Unikat\Univent;

class Action extends Event
{
    
    /**
     * Executes an action
     *
     * @param string $action Name of action
     * @param array  $args   Arguments passed to the action
     */
    public function fire($action, $args)
    {
        if ($this->getListeners()) {
            foreach ($this->getListeners() as $priority => $listeners) {
                foreach ($listeners as $hook => $arguments) {
                    if ($hook === $action) {
                        $parameters = [];
                        for ($i = 0; $i < $arguments['arguments']; $i++) {
                            if (isset($args[$i])) {
                                $parameters[] = $args[$i];
                            }
                        }
                        call_user_func_array($this->getFunction($arguments['callback']), $parameters);
                    }
                }
            }
        }
    }
}