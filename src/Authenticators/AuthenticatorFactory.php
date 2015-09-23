<?php
/**
 * @author JKetelaar
 */
namespace JKetelaar\Bitbucket\Authenticators;

use InvalidArgumentException;

class AuthenticatorFactory {
    /**
     * Make a new authenticator instance.
     *
     * @param string $method
     * @return AuthenticatorInterface
     * @throws InvalidArgumentException
     */
    public function make($method) {
        switch ($method) {
            case 'application':
                return new ApplicationAuthenticator();
        }
        throw new InvalidArgumentException("Unsupported authentication method [$method].");
    }
}
