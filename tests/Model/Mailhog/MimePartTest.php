<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Tests\Model\Mailhog;

use PHPUnit\Framework\Attributes\DataProvider;
use TwentytwoLabs\BehatFakeMailerExtension\Model\Mailhog\MimePart;
use PHPUnit\Framework\TestCase;

final class MimePartTest extends TestCase
{
    /**
     * @param array<string, mixed> $data
     * @param array<string, mixed> $expected
     */
    #[DataProvider('getResponse')]
    public function testShouldCreateMimePartFromResponse(array $data, array $expected): void
    {
        $mimePart = MimePart::fromResponse($data);
        $this->assertInstanceOf(MimePart::class, $mimePart);
        $this->assertSame($expected['content-type'], $mimePart->getContentType());
        $this->assertSame($expected['body'], $mimePart->getBody());
    }

    /**
     * @return array<int, mixed>
     */
    public static function getResponse(): array
    {
        return [
            [
                ['Headers' => [], 'Body' => 'Foobar'],
                ['content-type' => 'application/octet-stream', 'body' => 'Foobar'],
            ],
            [
                [
                    'Headers' => [
                        'Content-Type' => ['text/plain; charset=utf-8'],
                        'Content-Transfer-Encoding' => ['quoted-printable'],
                    ],
                    'Body' => 'M=C3=B6chten Sie ein paar =C3=84pfel?'
                ],
                [
                    'content-type' => 'text/plain',
                    'body' => 'Möchten Sie ein paar Äpfel?',
                ],
            ],
            [
                [
                    'Headers' => [
                        'Content-Type' => ['text/plain; charset=utf-8'],
                        'Content-Transfer-Encoding' => ['base64'],
                    ],
                    'Body' => 'TcO2Y2h0ZW4gU2llIGVpbiBwYWFyIMOEcGZlbD8='
                ],
                [
                    'content-type' => 'text/plain',
                    'body' => 'Möchten Sie ein paar Äpfel?',
                ],
            ],
        ];
    }
}
