<?php

namespace JKetelaar\Bitbucket;
use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * @author JKetelaar
 */
class BitbucketManager extends AbstractManager {

    /**
     * The factory instance.
     *
     * @var \JKetelaar\Bitbucket\BitbucketFactory
     */
    protected $factory;

    /**
     * Create a new Bitbucket manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \JKetelaar\Bitbucket\BitbucketFactory $factory
     */
    public function __construct(Repository $config, BitbucketFactory $factory)
    {
        parent::__construct($config);
        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return \Github\Client
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'bitbucket';
    }

    /**
     * Get the factory instance.
     *
     * @return \JKetelaar\Bitbucket\BitbucketFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}