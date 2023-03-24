<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Contracts\Routing\ResponseFactory;

class Controller extends BaseController
{
    /**
     * @var \Illuminate\Contracts\Routing\ResponseFactory
     */
    protected $responseFactory;

    /**
     * Controller constructor.
     * @param ResponseFactory $responseFactory
     */
    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * Returns response in appropriate format.
     *
     * @param mixed $data
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return \Illuminate\Http\JsonResponse
     */
    protected function response($data, $status = 200, array $headers = [], $options = 0)
    {
        return $this->responseFactory->json([
            'data' => $data
        ], $status, $headers, $options);
    }

    /**
     * Returns error message.
     *
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error($message = '', $status = 500)
    {
        $message = $message ?: $this->getDefaultError();

        return $this->response($message, $status);
    }
}
