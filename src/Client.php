<?php
namespace unapi\mailru;

class Client extends \GuzzleHttp\Client
{
    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        if (!array_key_exists('base_uri', $config))
            $config['base_uri'] = 'https://mail.ru';

        if (!array_key_exists('cookies', $config))
            $config['cookies'] = true;

        if (!array_key_exists('verify', $config))
            $config['verify'] = false;

        parent::__construct($config);
    }
}