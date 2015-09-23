<?php
/**
 * @author JKetelaar
 */
namespace JKetelaar\Bitbucket\Authenticators;

use Bitbucket\API\Api;

interface AuthenticatorInterface {
    /**
     * Set the client to perform the authentication on.
     *
     * @param \Bitbucket\API\Api $client
     *
     * @return \JKetelaar\Bitbucket\Authenticators\AuthenticatorInterface
     */
    public function with(Api $client);

    /**
     * Authenticate the client, and return it.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return \Bitbucket\API\Api
     */
    public function authenticate(array $config);
}
