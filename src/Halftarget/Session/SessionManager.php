<?php namespace Halftarget\Session;

use Illuminate\Session\Store;
use Illuminate\Session\EncryptedStore;

class SessionManager extends \Illuminate\Session\SessionManager {

    /**
     * Build the session instance.
     *
     * @param  \SessionHandlerInterface  $handler
     * @return \Illuminate\Session\Store
     */
    protected function buildSession($handler)
    {
        if( !isset($this->app['config']['session.header']) ){
            throw new \Exception("Session header name must be configured");
        }

        if ($this->app['config']['session.encrypt'])
        {
            return new EncryptedStore(
                $this->app['config']['session.header'], $handler, $this->app['encrypter']
            );
        }
        else
        {
            return new Store($this->app['config']['session.header'], $handler);
        }
    }
} 