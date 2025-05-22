<?php

namespace olegfill\IKassa\Auth;

use Exception;
use olegfill\IKassa\Auth\Mappers\AccessTokenDataMapper;
use olegfill\IKassa\Auth\Mappers\BindingDataMapper;
use olegfill\IKassa\Auth\Models\AccessTokenData;
use olegfill\IKassa\Auth\Models\BindingData;
use olegfill\IKassa\Auth\Routes\AuthRoutes;
use olegfill\IKassa\AuthData;
use olegfill\IKassa\HttpClient;
use Throwable;

class Auth
{
    private AuthData $authData;
    private HttpClient $httpClient;
    private AuthRoutes $authRoutes;

    public function __construct(AuthData $authData)
    {
        $this->authData = $authData;
        $this->authRoutes = new AuthRoutes($this->authData);

        $this->httpClient = new HttpClient(
            ['Content-Type' => 'application/x-www-form-urlencoded'],
            function (array $result) {
                if (!empty($result['error'])) {
                    throw new Exception($result['error_description']);
                }
            }
        );
    }

    /**
     * @throws Throwable
     */
    public function bindingData(string $osName, string $osVersion, string $deviceName, string $appName): BindingData
    {
        return BindingDataMapper::newInstance(
            $this->httpClient->sendRequest($this->authRoutes->getBindingRoute($osName, $osVersion, $deviceName, $appName))
        );
    }

    /**
     * @throws Throwable
     */
    public function getAccessTokenData(string $deviceCode): AccessTokenData
    {
        return AccessTokenDataMapper::newInstance(
            $this->httpClient->sendRequest($this->authRoutes->getAccessTokenRoute($deviceCode))
        );
    }

    /**
     * @throws Throwable
     */
    public function refreshAccessTokenData(string $refreshToken): AccessTokenData
    {
        return AccessTokenDataMapper::newInstance(
            $this->httpClient->sendRequest($this->authRoutes->getRefreshTokenRoute($refreshToken))
        );
    }
}