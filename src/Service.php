<?php
namespace unapi\mailru;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Promise\FulfilledPromise;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Promise\RejectedPromise;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use unapi\interfaces\ServiceInterface;
use unapi\mailru\exceptions\ParserException;
use unapi\mailru\parser\Mailbox;

class Service implements ServiceInterface, LoggerAwareInterface
{
    /** @var Client */
    private $client;
    /** @var LoggerInterface */
    private $logger;

    const URL_INIT = 'https://account.mail.ru/login/';
    const URL_AUTH = 'https://auth.mail.ru/cgi-bin/auth';
    const URL_THREADS = 'https://e.mail.ru/api/v1/threads/status/golang';

    /**
     * @param array $config Service configuration settings.
     */
    public function __construct(array $config = [])
    {
        if (!isset($config['client'])) {
            $this->client = new Client();
        } elseif ($config['client'] instanceof ClientInterface) {
            $this->client = $config['client'];
        } else {
            throw new \InvalidArgumentException('Client must be instance of ClientInterface');
        }

        if (!isset($config['logger'])) {
            $this->logger = new NullLogger();
        } elseif ($config['logger'] instanceof LoggerInterface) {
            $this->setLogger($config['logger']);
        } else {
            throw new \InvalidArgumentException('Logger must be instance of LoggerInterface');
        }
    }

    /**
     * @inheritdoc
     */
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    /**
     * @return ClientInterface
     */
    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * @param CredentialsInterface $credentials
     * @return PromiseInterface
     */
    public function getToken(CredentialsInterface $credentials): PromiseInterface
    {
        return $this->initialPage()->then(function (ResponseInterface $response) use ($credentials) {
            if (!preg_match("/<input type=\"hidden\" name=\"act_token\" value=\"([^\"]+)\"/im", $response->getBody()->getContents(), $matches))
                return new RejectedPromise(new ParserException('act_token not found'));

            return $this->submitForm($credentials, $matches[1])->then(function (ResponseInterface $response) {
                if (!preg_match("/patron.updateToken\(\"([^\"]+)\"\)/im", $response->getBody()->getContents(), $matches))
                    return new RejectedPromise(new ParserException('token not found'));

                return new FulfilledPromise($matches[1]);
            });
        });
    }

    /**
     * @param CredentialsInterface $credentials
     * @param string $token
     * @param int $offset
     * @param int $limit
     * @return PromiseInterface
     */
    public function getMailbox(CredentialsInterface $credentials, string $token, $offset = 0, $limit = 26): PromiseInterface
    {
        return $this->getClient()->requestAsync('GET', self::URL_THREADS, [
            'query' => [
                'ajax_call' => 1,
                'x-email' => $credentials->getEmail(),
                'tarball' => 'e.mail.ru-f-alpha-mail-65787-a.galtsev-1534150027.tgz',
                'tab-time' => time(),
                'email' => $credentials->getEmail(),
                'sort' => '{"type":"date","order":"desc"}',
                'offset' => $offset,
                'limit' => $limit,
                'folder' => 0,
                'htmlencoded' => 'false',
                'last_modified' => -1,
                'filters' => '{}',
                'nolog' => 0,
                'sortby' => 'D',
                'rnd' => mt_rand() / mt_getrandmax(),
                'api' => 1,
                'token' => $token,
            ]
        ])->then(function (ResponseInterface $response) {
            return new FulfilledPromise(new Mailbox($response->getBody()->getContents()));
        });
    }

    /**
     * @return PromiseInterface
     */
    protected function initialPage()
    {
        return $this->getClient()->requestAsync('GET', self::URL_INIT, [
            'query' => [
                'mode' => 'simple',
                'v' => '2.0.13',
                'type' => 'login',
                'allow_external' => 1,
                'success_redirect' => 'https://e.mail.ru/messages/inbox?back=1',
                'opener' => 'mail.login',
                'modal' => 1,
                'parent_url' => 'https://e.mail.ru/login'
            ]
        ]);
    }

    /**
     * @param CredentialsInterface $credentials
     * @param string $actToken
     * @return PromiseInterface
     */
    protected function submitForm(CredentialsInterface $credentials, string $actToken): PromiseInterface
    {
        return $this->getClient()->requestAsync('POST', self::URL_AUTH, [
            'headers' => [
                'Origin'=> 'https://account.mail.ru',
                'Upgrade-Insecure-Requests' => 1,
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36',
                'Accept-Encoding' => 'deflate',
                'Accept-Language' => 'ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
            ],
            'form_params' => [
                'Login' => $credentials->getLogin(),
                'Domain' => $credentials->getDomain(),
                'Password' => $credentials->getPassword(),
                'saveauth' => 1,
                'new_auth_form' => 1,
                'FromAccount' => 'opener=mail.login&allow_external=1',
                'act_token' => $actToken,
                'page' => 'https://e.mail.ru/messages/inbox?back=1&back=1&from=mail.login',
                'back' => 1,
            ]
        ]);
    }
}