<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Model\Mailhog;

class Headers
{
    /** @var array<string, string> */
    private array $headers;

    /**
     * @param array<string, string> $headers
     */
    public function __construct(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * @param array<int|string, mixed> $mailhogResponse
     */
    public static function fromResponse(array $mailhogResponse): self
    {
        return self::fromRawHeaders($mailhogResponse['Content']['Headers'] ?? []);
    }

    /**
     * @param array<int|string, mixed> $mimePart
     */
    public static function fromMimePart(array $mimePart): self
    {
        return self::fromRawHeaders($mimePart['Headers']);
    }

    /**
     * @param array<string, mixed> $rawHeaders
     */
    private static function fromRawHeaders(array $rawHeaders): self
    {
        $headers = [];
        foreach ($rawHeaders as $name => $header) {
            $value = $header[0] ?? null;
            if (!is_array($header) || empty($value)) {
                continue;
            }

            $decoded = iconv_mime_decode($value);

            $headers[strtolower($name)] = $decoded ?: $value;
        }

        return new Headers($headers);
    }

    public function get(string $name, string $default = ''): string
    {
        $name = strtolower($name);

        if (isset($this->headers[$name])) {
            return $this->headers[$name];
        }

        return $default;
    }

    public function has(string $name): bool
    {
        $name = strtolower($name);

        return isset($this->headers[$name]);
    }
}
