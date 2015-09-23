<?php
/**
 * @author JKetelaar
 */
namespace JKetelaar\Bitbucket\Authenticators;

use Bitbucket\API\Api;
use Bitbucket\API\Http\Listener\OAuth2Listener;
use Bitbucket\API\Repositories;
use InvalidArgumentException;
use Stevenmaguire\OAuth2\Client\Provider\Bitbucket;

class ApplicationAuthenticator extends AbstractAuthenticator implements AuthenticatorInterface {

    /**
     * Authenticate the client, and return it.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return \Bitbucket\API\Api
     */
    public function authenticate(array $config) {
        if (!$this->client) {
            throw new InvalidArgumentException('The client instance was not given to the application authenticator.');
        }
        if (!array_key_exists('clientId', $config) || !array_key_exists('clientSecret', $config) || !array_key_exists('redirectUri', $config)) {
            throw new InvalidArgumentException('The application authenticator requires a client id, secret and redirect uri.');
        }
        $provider = new Bitbucket([
            'clientId'     => $config['clientId'],
            'clientSecret' => $config['clientSecret'],
            'redirectUri'  => $config['redirectUri']
        ]);
        if (!isset($_GET['code'])) {
            $authUrl = $provider->getAuthorizationUrl();
            \Session::put('oauth2state', $provider->getState());
            header('Location: ' . $authUrl);
            exit;

        } elseif (empty($_GET['state']) || ($_GET['state'] !== \Session::get('oauth2state'))) {
            unset($_SESSION['oauth2state']);
            exit('Invalid state');

        } else {
            $token = $provider->getAccessToken('authorization_code', [
                'code' => $_GET['code']
            ]);
            $this->client->getClient()->addListener(
                new OAuth2Listener(
                    array('access_token' => $token->getToken())
                )
            );
        }
        return $this->client;
    }
}