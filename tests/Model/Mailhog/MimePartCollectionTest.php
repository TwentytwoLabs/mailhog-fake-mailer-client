<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Tests\Model\Mailhog;

use PHPUnit\Framework\Attributes\DataProvider;
use TwentytwoLabs\BehatFakeMailerExtension\Model\Mailhog\MimePartCollection;
use PHPUnit\Framework\TestCase;

final class MimePartCollectionTest extends TestCase
{
    /**
     * @param array<string, mixed> $data
     * @param array<string, mixed> $expected
     */
    #[DataProvider('getResponse')]
    public function testShouldCreateMimePartCollectionFromResponse(array $data, array $expected): void
    {
        $mimePartCollection = MimePartCollection::fromResponse($data);

        $this->assertInstanceOf(MimePartCollection::class, $mimePartCollection);
        $this->assertSame($expected['is-empty'], $mimePartCollection->isEmpty());
        $this->assertSame($expected['body'], $mimePartCollection->getBody());
    }

    /**
     * @return array<int, mixed>
     */
    public static function getResponse(): array
    {
        return [
            [
                [
                    [
                        'MIME' => [
                            'Parts' => [
                                [
                                    'MIME' => [
                                        'Parts' => [
                                            [
                                                'Headers' => [
                                                    'Content-Transfer-Encoding' => ['quoted-printable'],
                                                    'Content-Type' => ['text/plain; charset=utf-8'],
                                                ],
                                                'Body' => 'Willst du ein paar Bananen?',
                                            ],
                                            [
                                                'Headers' => [
                                                    'Content-Transfer-Encoding' => ['base64'],
                                                    'Content-Type' => ['text/html; charset=utf-8'],
                                                ],
                                                'Body' => 'V2lsbHN0IGR1IGVpbiBwYWFyIMOEcGZlbD8=',
                                            ],
                                            [
                                                'Headers' => [
                                                    'Content-Transfer-Encoding' => ['base64'],
                                                    'Content-Type' => ['text/html; charset=utf-8'],
                                                ],
                                                'Body' => 'V2lsbHN0IGR1IGVpbiBwYWFyIEJpcm5lbj8=',
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'MIME' => [
                                        'Parts' => [
                                            [
                                                'Headers' => [
                                                    'Content-Transfer-Encoding' => ['base64'],
                                                    'Content-Type' => ['text/plain; charset=utf-8'],
                                                ],
                                                'Body' => 'V2lsbHN0IGR1IGVpbiBwYWFyIE1hbmdvcz8=',
                                            ],
                                            [
                                                'Headers' => [
                                                    'Content-Transfer-Encoding' => ['base64'],
                                                    'Content-Type' => ['text/plain; charset=utf-8'],
                                                ],
                                                'Body' => 'V2lsbHN0IGR1IEVyZGJlZXJlbj8=',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'Headers' => [
                            'Content-Transfer-Encoding' => ['quoted-printable'],
                            'Content-Type' => ['text/plain; charset=utf-8'],
                        ],
                        'Body' => 'Willst du Himbeeren?',
                    ],
                ],
                [
                    'is-empty' => false,
                    'body' => 'Willst du ein paar Äpfel?',
                ],
            ],
            [
                [
                    [
                        'Headers' => [
                            'Content-Transfer-Encoding' => ['quoted-printable'],
                            'Content-Type' => ['text/plain; charset=utf-8'],
                        ],
                        'Body' => 'Willst du Himbeeren?',
                    ],
                ],
                [
                    'is-empty' => false,
                    'body' => 'Willst du Himbeeren?',
                ],
            ],
            [
                [
                    [
                        'Headers' => [
                            'Content-Transfer-Encoding' => ['quoted-printable'],
                            'Content-Type' => ['application/json; charset=utf-8'],
                        ],
                        'Body' => '["Willst du Himbeeren?"]',
                    ],
                ],
                [
                    'is-empty' => false,
                    'body' => '',
                ],
            ],
        ];
    }
}
