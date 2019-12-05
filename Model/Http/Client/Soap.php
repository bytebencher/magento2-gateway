<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Http\Client;

use Magento\Framework\Phrase;
use Magento\Framework\Webapi\Soap\ClientFactory as ClientAdapterFactory;
use SR\Gateway\Api\Http\Client\ClientInterface;
use SR\Gateway\Api\Http\ConverterInterface;
use SR\Gateway\Api\Http\TransferInterface;
use SR\Gateway\Api\LoggerInterface;
use SR\Gateway\Exception\ClientException;

class Soap implements ClientInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var ClientAdapterFactory
     */
    protected $clientAdapterFactory;

    /**
     * @var ConverterInterface|null
     */
    protected $converter;

    /**
     * Rest constructor.
     * @param LoggerInterface $logger
     * @param ClientAdapterFactory $clientAdapterFactory
     * @param ConverterInterface|null $converter
     */
    public function __construct(
        LoggerInterface $logger,
        ClientAdapterFactory $clientAdapterFactory,
        ConverterInterface $converter = null
    ) {
        $this->logger = $logger;
        $this->clientAdapterFactory = $clientAdapterFactory;
        $this->converter = $converter;
    }

    /**
     * @inheritDoc
     */
    public function placeRequest(TransferInterface $transferObject)
    {
        $log = [
            'client' => static::class,
            'client_config' => $transferObject->getClientConfig(),
            'endpoint_url' => $transferObject->getUri(),
            'headers' => $transferObject->getHeaders(),
            'request_method' => $transferObject->getMethod(),
            //'user' => $transferObject->getAuthUsername(),// TODO: uncomment when it is needed
            //'password' => $transferObject->getAuthPassword(),// TODO: uncomment when it is needed
            'request' => $transferObject->getBody(),
        ];
        $response['object'] = [];

        try {
            /** @var \SoapClient $clientAdapter */
            $clientAdapter = $this->clientAdapterFactory->create($transferObject->getClientConfig()['wsdl'], [
                'location' => $transferObject->getUri(),
                'trace' => true,
            ]);

            $clientAdapter->__setSoapHeaders($transferObject->getHeaders());

            $result = $clientAdapter->__soapCall($transferObject->getMethod(), [$transferObject->getBody()]);

            if (!is_null($this->converter)) {
                $result = $this->converter->convert($result);
            }

            $response['object'] = $result;
        } catch (\SoapFault $fault) {
            $message = $fault->getCode() . ' ' . $fault->getMessage();
            $this->logger->critical($message);

            // HOOK
            // @see: https://bugs.php.net/bug.php?id=47584
            // SoapFault exception could not be caught. It is always passed forward
            error_clear_last();

            throw new ClientException(__($message));
        } catch (\Exception $e) {
            $message = $e->getMessage() ?: 'Sorry, but something went wrong';
            $this->logger->critical($message);
            throw new ClientException(new Phrase($message), $e);
        } finally {
            if (isset($client)) {
                $log['last_request'] = $client->__getLastRequest();
                $log['last_response'] = $client->__getLastResponse();

                $log['response'] = $response['last_response'];
                $this->logger->debug($log);
            }
        }

        return $response;
    }
}
