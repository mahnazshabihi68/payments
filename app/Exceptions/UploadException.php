<?php

namespace App\Exceptions;

use App\Exceptions\Base\BaseException;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UploadException extends BaseException
{
    /**
     * @var string
     */
    public const UPLOAD_FAILED = 'upload_failed';

    /**
     * @var string
     */
    public const UPLOAD_MIME_VALIDATE_FAILED = 'upload_mime_validate_failed';

    /**
     * @var string
     */
    public const UPLOAD_SIZE_VALIDATE_FAILED = 'upload_size_validate_failed';

    /**
     * @param string|null $exceptionMessage
     * @param string|null $exceptionErrorCode
     * @param int|null $exceptionStatusCode
     * @param array|null $exceptionErrors
     * @param array|null $exceptionHeaders
     */
    public function __construct(
        protected ?string $exceptionMessage = null,
        protected ?string $exceptionErrorCode = null,
        protected ?int $exceptionStatusCode = null,
        protected ?array $exceptionErrors = [],
        protected ?array $exceptionHeaders = [],
    ) {
        $this->setExceptionBag($exceptionErrorCode, $this->getExceptionBag());
        parent::__construct();
    }

    /**
     * @return array[]
     */
    #[ArrayShape([
        self::UPLOAD_FAILED => "array",
        self::UPLOAD_MIME_VALIDATE_FAILED => "array",
        self::UPLOAD_SIZE_VALIDATE_FAILED => "array",
    ])]
    protected function getExceptionBag(): array
    {
        return [
            self::UPLOAD_FAILED => [
                self::STATUS_CODE_INDEX => $this->getExceptionStatusCode() ?? ResponseAlias::HTTP_BAD_REQUEST,
                self::ERROR_CODE_INDEX => self::UPLOAD_FAILED,
                self::MESSAGE_INDEX => $this->getExceptionMessage() ?: __(
                    'messages.exceptions.' . self::UPLOAD_FAILED
                ),
            ],
            self::UPLOAD_MIME_VALIDATE_FAILED => [
                self::STATUS_CODE_INDEX => $this->getExceptionStatusCode() ?? ResponseAlias::HTTP_BAD_REQUEST,
                self::ERROR_CODE_INDEX => self::UPLOAD_MIME_VALIDATE_FAILED,
                self::MESSAGE_INDEX => $this->getExceptionMessage() ?: __(
                    'messages.exceptions.' . self::UPLOAD_MIME_VALIDATE_FAILED
                ),
            ],
            self::UPLOAD_SIZE_VALIDATE_FAILED => [
                self::STATUS_CODE_INDEX => $this->getExceptionStatusCode() ?? ResponseAlias::HTTP_BAD_REQUEST,
                self::ERROR_CODE_INDEX => self::UPLOAD_SIZE_VALIDATE_FAILED,
                self::MESSAGE_INDEX => $this->getExceptionMessage() ?: __(
                    'messages.exceptions.' . self::UPLOAD_SIZE_VALIDATE_FAILED
                ),
            ],
        ];
    }
}
