<?php

namespace App\Exceptions\Base;

use App\Helpers\Logger;
use App\Services\Log\Formatters\ConsoleLogFormatter;
use App\Traits\ApiResponder;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

abstract class BaseException extends Exception
{
    use ApiResponder;

    /**
     * @var string
     */
    public const DEFAULT_EXCEPTION_ERROR_CODE = 'unhandled_error';
    /**
     * @var string
     */
    public const DATABASE_ERROR_CODE = 'database_error';
    /**
     * @var string
     */
    public const INTERNAL_SERVER_ERROR = 'internal_server_error';
    /**
     * @var string
     */
    public const NOT_FOUND_ERROR = 'not_found';
    /**
     * @var string
     */
    public const NOT_ENABLED_ERROR = 'not_enabled';
    /**
     * @var string
     */
    public const DEFAULT_EXCEPTION_STATUS_CODE = ResponseAlias::HTTP_BAD_REQUEST;
    /**
     * @var string
     */
    public const DEFAULT_EXCEPTION_MESSAGE = 'Unhandled error message';
    /**
     * @var string
     */
    public const STATUS_CODE_INDEX = 'status_code';
    /**
     * @var string
     */
    public const ERROR_CODE_INDEX = 'error_code';
    /**
     * @var string
     */
    public const MESSAGE_INDEX = 'message';
    /**
     * @var string|null
     */
    protected ?string $exceptionErrorCode;
    /**
     * @var int|null
     */
    protected int|null $exceptionStatusCode;
    /**
     * @var string|null
     */
    protected string|null $exceptionMessage;
    /**
     * @var array|null
     */
    protected array|null $exceptionErrors = [];
    /**
     * @var array|null
     */
    protected array|null $exceptionHeaders = [];
    /**
     * @var mixed|null
     */
    protected mixed $exceptionContextualData = null;

    /**
     * @return string|null
     */
    public function getExceptionErrorCode(): ?string
    {
        return $this->exceptionErrorCode;
    }

    /**
     * @param  string|null  $exceptionErrorCode
     * @return BaseException
     */
    public function setExceptionErrorCode(?string $exceptionErrorCode): self
    {
        $this->exceptionErrorCode = $exceptionErrorCode;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getExceptionStatusCode(): ?int
    {
        return $this->exceptionStatusCode;
    }

    /**
     * @param  int|null  $exceptionStatusCode
     * @return BaseException
     */
    public function setExceptionStatusCode(?int $exceptionStatusCode): self
    {
        $this->exceptionStatusCode = $exceptionStatusCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getExceptionMessage(): ?string
    {
        return $this->exceptionMessage;
    }

    /**
     * @param  string|null  $exceptionMessage
     * @return BaseException
     */
    public function setExceptionMessage(?string $exceptionMessage): self
    {
        $this->exceptionMessage = $exceptionMessage;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getExceptionErrors(): ?array
    {
        return $this->exceptionErrors;
    }

    /**
     * @param  array|null  $exceptionErrors
     * @return BaseException
     */
    public function setExceptionErrors(?array $exceptionErrors): self
    {
        $this->exceptionErrors = $exceptionErrors;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getExceptionHeaders(): ?array
    {
        return $this->exceptionHeaders;
    }

    /**
     * @param  array|null  $exceptionHeaders
     * @return BaseException
     */
    public function setExceptionHeaders(?array $exceptionHeaders): self
    {
        $this->exceptionHeaders = $exceptionHeaders;
        return $this;
    }

    /**
     * @return mixed|null
     */
    public function getExceptionContextualData(): mixed
    {
        return $this->exceptionContextualData;
    }

    /**
     * @param  mixed|null  $exceptionContextualData
     * @return BaseException
     */
    public function setExceptionContextualData(mixed $exceptionContextualData): self
    {
        $this->exceptionContextualData = $exceptionContextualData;
        return $this;
    }


    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function render(Request $request): JsonResponse
    {
        return $this->respondWithError(
            statusCode: $this->getExceptionStatusCode(),
            errorCode: $this->getExceptionErrorCode(),
            APImessage: $this->getExceptionMessage(),
            headers: $this->getExceptionHeaders(),
            errors: $this->getExceptionErrors()
        );
    }

    /**
     * @return bool
     */
    public function report(): bool
    {
        Logger::error(
            message: $this->getExceptionMessage(),
            data: [
                'status_code' => $this->getExceptionStatusCode(),
                'error_code' => $this->getExceptionErrorCode(),
                'message' => $this->getExceptionMessage(),
                'headers' => $this->getExceptionHeaders(),
                'errors' => $this->getExceptionErrors(),
                'trace' => $this->getTraceAsString(),
                'contextual_data' => $this->getExceptionContextualData(),
            ]
        );
        return false;
    }

    /**
     * @param  string|null  $baseExceptionErrorCode
     * @param  array  $lookup
     *
     * @return void
     */
    protected function setExceptionBag(?string $baseExceptionErrorCode, array $lookup): void
    {
        $criteria = array_key_exists($baseExceptionErrorCode, $lookup);

        $statusCode = $criteria ? $lookup[$baseExceptionErrorCode][self::STATUS_CODE_INDEX] : $this->getExceptionStatusCode(
            ) ?? self::DEFAULT_EXCEPTION_STATUS_CODE;
        $errorCode = $criteria ? $lookup[$baseExceptionErrorCode][self::ERROR_CODE_INDEX] : $this->getExceptionErrorCode(
            ) ?? self::DEFAULT_EXCEPTION_ERROR_CODE;
        $message = $criteria ? $lookup[$baseExceptionErrorCode][self::MESSAGE_INDEX] : $this->getExceptionMessage(
            ) ?? self::DEFAULT_EXCEPTION_MESSAGE;

        $this->setExceptionStatusCode($statusCode)
            ->setExceptionErrorCode($errorCode)
            ->setExceptionMessage($message)
            ->setExceptionErrors($this->getExceptionErrors() ?? [])
            ->setExceptionHeaders($this->getExceptionHeaders() ?? []);
    }

    /**
     * @return array
     */
    abstract protected function getExceptionBag(): array;
}
