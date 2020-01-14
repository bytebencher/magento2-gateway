<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Http\Client;

use Magento\Framework\Phrase;
use SR\Gateway\Api\Http\Client\ClientInterface;
use SR\Gateway\Api\Http\ConverterInterface;
use SR\Gateway\Api\Http\TransferInterface;
use SR\Gateway\Api\LoggerInterface;
use SR\Gateway\Exception\ClientException;
use SR\Gateway\Model\Http\Adapter\CurlAdapter as ClientAdapter;
use SR\Gateway\Model\Http\Adapter\CurlAdapterFactory as ClientAdapterFactory;
use Zend\Http\Request as HttpRequest;
use Zend\Http\Response as HttpResponse;

class Rest implements ClientInterface
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
        $encodedRequestBody = json_encode($transferObject->getBody());

        try {
            /** @var ClientAdapter $clientAdapter */
            $clientAdapter = $this->clientAdapterFactory->create();

            if (!$transferObject->getAuthUsername() || !$transferObject->getAuthPassword()) {
                throw new ClientException(new Phrase('API Credentials are invalid. Please check corresponding Configuration Parameters and try again'));
            }

            $clientAdapter->setConfig([
                'userpwd' => $transferObject->getAuthUsername() . ':' . $transferObject->getAuthPassword(),
                'timeout' => 60,
                'verifypeer' => false,
                'verifyhost' => false,
            ]);

            $clientAdapter->addOption(CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            $clientAdapter->addOption(CURLINFO_HEADER_OUT, true);

            /**
             * CURLOPT_FAILONERROR Description:
             *     TRUE to fail verbosely if the HTTP code returned is greater than or equal to 400.
             *     The default behavior is to return the page normally, ignoring the code.
             *
             * This means when TRUE the BODY is not returned for such cases.
             *
             * NOTE: but we NEED to get the BODY on Error/Fail because it contains the descriptions of the Error (ex: in XML format).
             */
            $clientAdapter->addOption(CURLOPT_FAILONERROR, false);

            // TODO: implement logic to pass Options using $transferObject

            // NOTE: the TRICK to use PATCH method
            if ($transferObject->getMethod() === HttpRequest::METHOD_PATCH) {
                $clientAdapter->addOption(CURLOPT_CUSTOMREQUEST, HttpRequest::METHOD_PATCH);
                $clientAdapter->addOption(CURLOPT_POSTFIELDS, $encodedRequestBody);
            }

            $log['request'] = $clientAdapter->write(
                $transferObject->getMethod(),
                $transferObject->getUri(),
                '1.1',
                $transferObject->getHeaders(),
                $encodedRequestBody
            );

            /** @var HttpResponse $httpResponse */
            $httpResponse = $clientAdapter->singleExec();
            if ($errorMessage = $clientAdapter->getError()) {
                throw new ClientException(new Phrase('HTTP Adapter Error :: ' . $errorMessage));
            }

            if (empty($httpResponse->getBody()) && !in_array($httpResponse->getStatusCode(), [200, 201])) {
                throw new ClientException(new Phrase('HTTP Adapter Error :: ' . $httpResponse->getStatusCode() . ' : ' . $httpResponse->getReasonPhrase()));
            }

            $response['object'] = $this->converter ? $this->converter->convert($httpResponse->getBody()) : $httpResponse->getBody();
        } catch (\Exception $e) {
            $message = $e->getMessage() ?: 'Sorry, but something went wrong';
            $this->logger->critical($message);
            throw new ClientException(new Phrase($message), $e);
        } finally {
            // NOTE: destruct CURL resource
            $clientAdapter->close();

            $response['last_request'] = $encodedRequestBody;
            $response['last_response'] = isset($httpResponse) ? $httpResponse->getBody() : '';

            $log['response'] = $response['last_response'];
            $this->logger->debug($log);
        }

        return $response;
    }
}
