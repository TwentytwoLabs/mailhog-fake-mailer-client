<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Model\Mailhog;

class MimePart
{
    private string $contentType;
    private ?string $contentTransferEncoding;
    private string $body;

    public function __construct(
        string $contentType,
        ?string $contentTransferEncoding,
        string $body
    ) {
        $this->contentType = $contentType;
        $this->contentTransferEncoding = $contentTransferEncoding;
        $this->body = $body;
    }

    /**
     * @param array<string, mixed> $mimePart
     */
    public static function fromResponse(array $mimePart): MimePart
    {
        $headers = Headers::fromMimePart($mimePart);

        return new self(
            $headers->has('Content-Type')
                ? explode(';', $headers->get('Content-Type'))[0]
                : 'application/octet-stream',
            $headers->has('Content-Transfer-Encoding')
                ? $headers->get('Content-Transfer-Encoding')
                : null,
            $mimePart['Body']
        );
    }

    public function getContentType(): string
    {
        return $this->contentType;
    }

    public function getBody(): string
    {
        if (false !== stripos($this->contentTransferEncoding ?? '', 'quoted-printable')) {
            return quoted_printable_decode($this->body);
        }

        if (false !== stripos($this->contentTransferEncoding ?? '', 'base64')) {
            return base64_decode($this->body);
        }

        return $this->body;
    }
}
