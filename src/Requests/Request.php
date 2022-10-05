<?php
namespace MouradA\Blog\Requests;


class Request implements RequestInterface
{
    public function __construct(protected array $requestData, protected array $requestParams=[])
    {
    }

    public function validate(): bool
    {
        // TODO: Implement validate() method.
    }


}