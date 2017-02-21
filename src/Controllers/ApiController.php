<?php

namespace CashMachine\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class ApiController
{
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function unavailableResponse($message = 'Unavailable Response')
    {
        return $this->errorResponse(Response::HTTP_NOT_FOUND, $message);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function InvalidArgumentResponse($message = 'Invalid Argument')
    {
        return $this->errorResponse(Response::HTTP_FORBIDDEN, $message);
    }

    /**
     * @param $errorStatusCode
     * @param $message
     * @return mixed
     */
    public function errorResponse($errorStatusCode, $message)
    {
        $errorData = [
            'error' => [
                'message' => $message
            ]
        ];

        return $this->apiResponse($errorData, $errorStatusCode);
    }

    /**
     * @param array $data
     * @param int $statusCode
     * @return mixed
     */
    public function apiResponse(array $data, $statusCode = Response::HTTP_OK)
    {
        $data['meta'] = [
            'status_code' => $statusCode
        ];

        return new JsonResponse($data, $statusCode);
    }
}