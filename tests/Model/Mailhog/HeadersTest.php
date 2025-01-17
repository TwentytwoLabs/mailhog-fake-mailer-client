<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Tests\Model\Mailhog;

use TwentytwoLabs\BehatFakeMailerExtension\Model\Mailhog\Headers;
use PHPUnit\Framework\TestCase;

final class HeadersTest extends TestCase
{
    public function testShouldCreateHeadersFromResponse(): void
    {
        $data = [
            'Cc' => ['John Doe - Example <john.doe@example.org>, Jane Doe - Example <jane.doe@example.org>'],
            'Foo' => 'Bar',
            'Bar' => [],
            'To' => ['John Doe <john.doe@gmail.com>, Jane Doe <jane.doe@gmail.com>'],
        ];

        $headers = Headers::fromResponse(['Content' => ['Headers' => $data]]);

        $this->assertInstanceOf(Headers::class, $headers);
        $this->assertTrue($headers->has('To'));
        $this->assertSame('John Doe <john.doe@gmail.com>, Jane Doe <jane.doe@gmail.com>', $headers->get('To'));
        $this->assertFalse($headers->has('Foo'));
        $this->assertSame('Default Value', $headers->get('Foo', 'Default Value'));
        $this->assertFalse($headers->has('Bar'));
        $this->assertSame('Default Value', $headers->get('Bar', 'Default Value'));
    }
}
