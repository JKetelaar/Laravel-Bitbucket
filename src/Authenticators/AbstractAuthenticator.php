<?php
/**
 * @author JKetelaar
 */
namespace JKetelaar\Bitbucket\Authenticators;

use Bitbucket\API\Api;

abstract class AbstractAuthenticator {

    /**
     * @var $client \Bitbucket\API\Api
     */
    protected $client;

    /**
     * Set the client to perform the authentication on.
     *
     * @param \Bitbucket\API\Api $client
     *
     * @return \JKetelaar\Bitbucket\Authenticators\AuthenticatorInterface
     */
    public function with(Api $client) {
        $this->client = $client;
        return $this;
    }
}