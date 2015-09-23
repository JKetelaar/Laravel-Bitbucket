<?php
/**
 * @author JKetelaar
 */
namespace JKetelaar\Bitbucket;

use Bitbucket\API\Api;
use JKetelaar\Bitbucket\Authenticators\ApplicationAuthenticator;
use JKetelaar\Bitbucket\Authenticators\AuthenticatorFactory;

class BitbucketFactory {

    /**
     * The authenticator factory instance.
     *
     * @var \JKetelaar\Bitbucket\Authenticators\AuthenticatorFactory
     */
    protected $auth;

    /**
     * The cache path.
     *
     * @var string
     */
    protected $path;

    /**
     * Create a new bitbucket factory instance.
     *
     * @param AuthenticatorFactory $auth
     * @param string $path
     *
     */
    public function __construct(AuthenticatorFactory $auth, $path) {
        $this->auth = $auth;
        $this->path = $path;
    }

    /**
     * Make a new Bitbucket client.
     *
     * @param string[] $config
     *
     * @return \Bitbucket\API\Api
     */
    public function make(array $config) {
        return $this->getClient($config);
    }

    /**
     * Get the main client.
     *
     * @param string[] $config
     *
     * @return \Bitbucket\API\Api
     */
    protected function getClient(array $config) {
        return $this->auth->make("application")->with(new Api())->authenticate($config);
    }

}