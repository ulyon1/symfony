<?php

namespace Metinet\App\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ApiExceptionKernelListener
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function onKernelException(GetResponseForExceptionEvent $event): void
    {
        $request = $event->getRequest();

        // In case the url is not an API call under the base path /api
        // we do not handle the exception
        if (0 !== strpos($request->getRequestUri(), '/api')) {

            return;
        }

        // You get the exception object from the received event
        $exception = $event->getException();
        $message = sprintf(
            'My Error says: %s with code: %s',
            $exception->getMessage(),
            $exception->getCode()
        );

        // You should be very careful with this and never do that in a production
        // environment. It may be dangerous to return the system exception message
        // as it may contain sensible data.

        $error = new HttpError(
            new Error(sprintf('%s (code: %s)', $exception->getMessage(), $exception->getCode())),
            Response::HTTP_INTERNAL_SERVER_ERROR
        );

        $response = JsonResponse::fromJsonString(
            $this->serializer->serialize($error, 'json'),
            $error->getHttpStatusCode()
        );

        // HttpExceptionInterface is a special type of exception that
        // holds status code and header details
        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        }

        $response->headers->set('Content-Type', 'application/json');
        $event->setResponse($response);
    }
}
