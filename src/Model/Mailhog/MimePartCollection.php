<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Model\Mailhog;

class MimePartCollection
{
    /**
     * @var array<string, mixed>
     */
    private array $mimeParts;

    /**
     * @param array<string, mixed> $mimeParts
     */
    public function __construct(array $mimeParts)
    {
        $this->mimeParts = $mimeParts;
    }

    /**
     * @param array<string, mixed> $mimeParts
     */
    public static function fromResponse(array $mimeParts): self
    {
        return new self(self::flattenParts($mimeParts));
    }

    public function isEmpty(): bool
    {
        return count($this->mimeParts) === 0;
    }

    public function getBody(): string
    {
        foreach ($this->mimeParts as $mimePart) {
            if (stripos($mimePart->getContentType(), 'text/html') === 0) {
                return $mimePart->getBody();
            }
        }

        foreach ($this->mimeParts as $mimePart) {
            if (stripos($mimePart->getContentType(), 'text/plain') === 0) {
                return $mimePart->getBody();
            }
        }

        return '';
    }

    /**
     * @param array<string, mixed> $mimeParts
     *
     * @return MimePart[]
     */
    private static function flattenParts(array $mimeParts): array
    {
        $flattenedParts = [];
        foreach ($mimeParts as $mimePart) {
            if (empty($mimePart['MIME']['Parts'])) {
                $flattenedParts[] = MimePart::fromResponse($mimePart);
                continue;
            }

            $flattenedParts = array_merge($flattenedParts, self::flattenParts($mimePart['MIME']['Parts']));
        }

        return $flattenedParts;
    }
}
