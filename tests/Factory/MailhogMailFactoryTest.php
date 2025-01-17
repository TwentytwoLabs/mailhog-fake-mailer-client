<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Tests\Factory;

use TwentytwoLabs\BehatFakeMailerExtension\Factory\MailhogMailFactory;
use PHPUnit\Framework\TestCase;
use TwentytwoLabs\BehatFakeMailerExtension\Model\Contact;
use TwentytwoLabs\BehatFakeMailerExtension\Model\Mail;

final class MailhogMailFactoryTest extends TestCase
{
    public function testShouldCreateMail(): void
    {
        $mail = MailhogMailFactory::createMail($this->getData());
        $this->assertInstanceOf(Mail::class, $mail);
        $this->assertSame('wPysmVJgr1MvNaiE3R91xCc-XtCpHeanuw_V2Fltg7U=@mailhog.example', $mail->getMessageId());

        $sender = $mail->getSender();
        $this->assertInstanceOf(Contact::class, $sender);
        $this->assertSame('No Reply Example', $sender->getName());
        $this->assertSame('no-reply@example.org', $sender->getEmailAddress());

        $recipients = $mail->getRecipients();
        $this->assertCount(2, $recipients);
        $this->assertInstanceOf(Contact::class, $recipients[0]);
        $this->assertSame('John Doe', $recipients[0]->getName());
        $this->assertSame('john.doe@gmail.com', $recipients[0]->getEmailAddress());
        $this->assertInstanceOf(Contact::class, $recipients[1]);
        $this->assertSame('Jane Doe', $recipients[1]->getName());
        $this->assertSame('jane.doe@gmail.com', $recipients[1]->getEmailAddress());

        $ccRecipients = $mail->getCcRecipients();
        $this->assertCount(2, $ccRecipients);
        $this->assertInstanceOf(Contact::class, $ccRecipients[0]);
        $this->assertSame('John Doe - Example', $ccRecipients[0]->getName());
        $this->assertSame('john.doe@example.org', $ccRecipients[0]->getEmailAddress());
        $this->assertInstanceOf(Contact::class, $ccRecipients[1]);
        $this->assertSame('Jane Doe - Example', $ccRecipients[1]->getName());
        $this->assertSame('jane.doe@example.org', $ccRecipients[1]->getEmailAddress());

        $bccRecipients = $mail->getBccRecipients();
        $this->assertCount(2, $bccRecipients);
        $this->assertInstanceOf(Contact::class, $bccRecipients[0]);
        $this->assertSame('John Doe', $bccRecipients[0]->getName());
        $this->assertSame('john.doe@gmail.com', $bccRecipients[0]->getEmailAddress());
        $this->assertInstanceOf(Contact::class, $bccRecipients[1]);
        $this->assertSame('Jane Doe', $bccRecipients[1]->getName());
        $this->assertSame('jane.doe@gmail.com', $bccRecipients[1]->getEmailAddress());

        $this->assertSame('Contact', $mail->getSubject());
        $this->assertSame('<!DOCTYPE html>\r\n<html>\r\n<head>\r\n    <meta charset=\'UTF-8\'>\r\n    <met=\r\na name=\'viewport\' content=\'width=device-width, initial-scale=1.0\'>=\r\n\r\n    <meta http-equiv=\'content-type\' content=\'text/html\'>\r\n    <titl=\r\ne>Email - Contact</title>\r\n</head>\r\n<body>\r\n<!DOCTYPE html PUBLIC \'-//W3=\r\nC//DTD HTML 4.0 Transitional//EN\' \'http://www.w3.org/TR/REC-html40/loose.dt=\r\nd\'>\r\n<html style=\'font-family => Lato, sans-serif;\'>\r\n<head style=\'font=\r\n-family => Lato, sans-serif;\'>\r\n<link href=\'https://fonts.googleapis.com/c=\r\nss2?family=Lato:wght@400;700&amp;family=Roboto:wght@700&amp;display=s=\r\nwap\' rel=\'stylesheet\' style=\'font-family => Lato, sans-serif;\'>\r\n    <st=\r\nyle style=\'font-family => Lato, sans-serif;\'>\r\n        * [\r\n            f=\r\nont-family => Lato, sans-serif;\r\n        ]\r\n        p [\r\n            color=\r\n => #39BAC1;\r\n        ]\r\n        a, a:hover [\r\n            text-decoration=\r\n => none;\r\n        ]\r\n    </style>\r\n    </head>\r\n<body style=\'font-fami=\r\nly => Lato, sans-serif;\'>\r\n<table width=\'100%\' style=\'font-family => Lato,=\r\n sans-serif;\'>\r\n        <tr style=\'font-family => Lato, sans-serif;\'>\r\n  =\r\n          <td align=\'center\' style=\'font-family => Lato, sans-serif;\'>\r\n=\r\n                Logo\r\n            </td>\r\n        </tr>\r\n    </table>\r\n =\r\n   <table align=\'center\' width=\'50%\' style=\'font-family => Lato, sans-s=\r\nerif;\'>\r\n        <tr align=\'center\' style=\'font-family => Lato, sans-ser=\r\nif;\'>\r\n            <th style=\'font-family => Lato, sans-serif;\'>Nom</th>=\r\n\r\n            <td style=\'font-family => Lato, sans-serif;\'>Alexandre Dumas=\r\n</td>\r\n        </tr>\r\n        <tr align=\'center\' style=\'font-family => =\r\nLato, sans-serif;\'>\r\n            <th style=\'font-family => Lato, sans-seri=\r\nf;\'>Type</th>\r\n            <td style=\'font-family => Lato, sans-serif;\'>re=\r\ncrutement</td>\r\n        </tr>\r\n        <tr align=\'center\' style=\'font=\r\n-family => Lato, sans-serif;\'>\r\n            <th style=\'font-family => Lato, =\r\nsans-serif;\'>Email</th>\r\n            <td style=\'font-family => Lato, sans-=\r\nserif;\'>alexandre.dumas@gmail.com</td>\r\n        </tr>\r\n        <tr align=\r\n=\'center\' style=\'font-family => Lato, sans-serif;\'>\r\n            <th sty=\r\nle=\'font-family => Lato, sans-serif;\'>Message</th>\r\n            <td style=\r\n=\'font-family => Lato, sans-serif;\'>Ceci est un test</td>\r\n        </tr>=\r\n\r\n        <tr align=\'center\' style=\'font-family => Lato, sans-serif;\'>=\r\n\r\n            <th style=\'font-family => Lato, sans-serif;\'>Date de cr=\r\néation</th>\r\n            <td style=\'font-family => Lato, sans-serif;\'=\r\n>16/01/2025 14:28:08</td>\r\n        </tr>\r\n    </table>\r\n</body>\r\n</html=\r\n></body>\r\n</html>', $mail->getBody());
    }

    public function testShouldCreateMailWithOutMimePartsAndWithOutContentTransferEncoding(): void
    {
        $data = $this->getData();
        unset($data['MIME']);
        $mail = MailhogMailFactory::createMail($data);

        $this->assertInstanceOf(Mail::class, $mail);
        $this->assertSame('wPysmVJgr1MvNaiE3R91xCc-XtCpHeanuw_V2Fltg7U=@mailhog.example', $mail->getMessageId());

        $sender = $mail->getSender();
        $this->assertInstanceOf(Contact::class, $sender);
        $this->assertSame('No Reply Example', $sender->getName());
        $this->assertSame('no-reply@example.org', $sender->getEmailAddress());

        $recipients = $mail->getRecipients();
        $this->assertCount(2, $recipients);
        $this->assertInstanceOf(Contact::class, $recipients[0]);
        $this->assertSame('John Doe', $recipients[0]->getName());
        $this->assertSame('john.doe@gmail.com', $recipients[0]->getEmailAddress());
        $this->assertInstanceOf(Contact::class, $recipients[1]);
        $this->assertSame('Jane Doe', $recipients[1]->getName());
        $this->assertSame('jane.doe@gmail.com', $recipients[1]->getEmailAddress());

        $ccRecipients = $mail->getCcRecipients();
        $this->assertCount(2, $ccRecipients);
        $this->assertInstanceOf(Contact::class, $ccRecipients[0]);
        $this->assertSame('John Doe - Example', $ccRecipients[0]->getName());
        $this->assertSame('john.doe@example.org', $ccRecipients[0]->getEmailAddress());
        $this->assertInstanceOf(Contact::class, $ccRecipients[1]);
        $this->assertSame('Jane Doe - Example', $ccRecipients[1]->getName());
        $this->assertSame('jane.doe@example.org', $ccRecipients[1]->getEmailAddress());

        $bccRecipients = $mail->getBccRecipients();
        $this->assertCount(2, $bccRecipients);
        $this->assertInstanceOf(Contact::class, $bccRecipients[0]);
        $this->assertSame('John Doe', $bccRecipients[0]->getName());
        $this->assertSame('john.doe@gmail.com', $bccRecipients[0]->getEmailAddress());
        $this->assertInstanceOf(Contact::class, $bccRecipients[1]);
        $this->assertSame('Jane Doe', $bccRecipients[1]->getName());
        $this->assertSame('jane.doe@gmail.com', $bccRecipients[1]->getEmailAddress());

        $this->assertSame('Contact', $mail->getSubject());
        $this->assertSame('--0R5oPBDn\r\nContent-Type => text/plain; charset=utf-8\r\nContent-Transfer-Encoding => quoted-printable\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n       =20\r\n           =20\r\n                Logo=\r\n\r\n           =20\r\n       =20\r\n   =20\r\n   =20\r\n       =20\r\n            Nom\r\n   =\r\n         Alexandre Dumas\r\n       =20\r\n       =20\r\n            Type\r\n       =\r\n     recrutement\r\n       =20\r\n       =20\r\n            Email\r\n            al=\r\nexandre.dumas@gmail.com\r\n       =20\r\n       =20\r\n            Message\r\n     =\r\n       Ceci est un test\r\n       =20\r\n       =20\r\n            Date de cr=\r\n=C3=A9ation\r\n            16/01/2025 14:28:08\r\n       =20\r\n   =20\r\n\r\n\r\n\r\n\r\n--0R5oPBDn\r\nContent-Type => text/html; charset=utf-8\r\nContent-Transfer-Encoding => quoted-printable\r\n\r\n<!DOCTYPE html>\r\n<html>\r\n<head>\r\n    <meta charset=3D\'UTF-8\'>\r\n    <met=\r\na name=3D\'viewport\' content=3D\'width=3Ddevice-width, initial-scale=3D1.0\'>=\r\n\r\n    <meta http-equiv=3D\'content-type\' content=3D\'text/html\'>\r\n    <titl=\r\ne>Email - Contact</title>\r\n</head>\r\n<body>\r\n<!DOCTYPE html PUBLIC \'-//W3=\r\nC//DTD HTML 4.0 Transitional//EN\' \'http://www.w3.org/TR/REC-html40/loose.dt=\r\nd\'>\r\n<html style=3D\'font-family => Lato, sans-serif;\'>\r\n<head style=3D\'font=\r\n-family => Lato, sans-serif;\'>\r\n<link href=3D\'https://fonts.googleapis.com/c=\r\nss2?family=3DLato:wght@400;700&amp;family=3DRoboto:wght@700&amp;display=3Ds=\r\nwap\' rel=3D\'stylesheet\' style=3D\'font-family => Lato, sans-serif;\'>\r\n    <st=\r\nyle style=3D\'font-family => Lato, sans-serif;\'>\r\n        * [\r\n            f=\r\nont-family => Lato, sans-serif;\r\n        ]\r\n        p [\r\n            color=\r\n => #39BAC1;\r\n        ]\r\n        a, a:hover [\r\n            text-decoration=\r\n => none;\r\n        ]\r\n    </style>\r\n    </head>\r\n<body style=3D\'font-fami=\r\nly => Lato, sans-serif;\'>\r\n<table width=3D\'100%\' style=3D\'font-family => Lato,=\r\n sans-serif;\'>\r\n        <tr style=3D\'font-family => Lato, sans-serif;\'>\r\n  =\r\n          <td align=3D\'center\' style=3D\'font-family => Lato, sans-serif;\'>\r\n=\r\n                Logo\r\n            </td>\r\n        </tr>\r\n    </table>\r\n =\r\n   <table align=3D\'center\' width=3D\'50%\' style=3D\'font-family => Lato, sans-s=\r\nerif;\'>\r\n        <tr align=3D\'center\' style=3D\'font-family => Lato, sans-ser=\r\nif;\'>\r\n            <th style=3D\'font-family => Lato, sans-serif;\'>Nom</th>=\r\n\r\n            <td style=3D\'font-family => Lato, sans-serif;\'>Alexandre Dumas=\r\n</td>\r\n        </tr>\r\n        <tr align=3D\'center\' style=3D\'font-family => =\r\nLato, sans-serif;\'>\r\n            <th style=3D\'font-family => Lato, sans-seri=\r\nf;\'>Type</th>\r\n            <td style=3D\'font-family => Lato, sans-serif;\'>re=\r\ncrutement</td>\r\n        </tr>\r\n        <tr align=3D\'center\' style=3D\'font=\r\n-family => Lato, sans-serif;\'>\r\n            <th style=3D\'font-family => Lato, =\r\nsans-serif;\'>Email</th>\r\n            <td style=3D\'font-family => Lato, sans-=\r\nserif;\'>alexandre.dumas@gmail.com</td>\r\n        </tr>\r\n        <tr align=\r\n=3D\'center\' style=3D\'font-family => Lato, sans-serif;\'>\r\n            <th sty=\r\nle=3D\'font-family => Lato, sans-serif;\'>Message</th>\r\n            <td style=\r\n=3D\'font-family => Lato, sans-serif;\'>Ceci est un test</td>\r\n        </tr>=\r\n\r\n        <tr align=3D\'center\' style=3D\'font-family => Lato, sans-serif;\'>=\r\n\r\n            <th style=3D\'font-family => Lato, sans-serif;\'>Date de cr=\r\n=C3=A9ation</th>\r\n            <td style=3D\'font-family => Lato, sans-serif;\'=\r\n>16/01/2025 14:28:08</td>\r\n        </tr>\r\n    </table>\r\n</body>\r\n</html=\r\n></body>\r\n</html>\r\n\r\n--0R5oPBDn--\r\n', $mail->getBody());
    }

    public function testShouldCreateMailWithOutMimeParts(): void
    {
        $data = $this->getData();
        unset($data['MIME']);
        $data['Content']['Headers']['Content-Transfer-Encoding'] = ['quoted-printable'];
        $mail = MailhogMailFactory::createMail($data);

        $this->assertInstanceOf(Mail::class, $mail);
        $this->assertSame('wPysmVJgr1MvNaiE3R91xCc-XtCpHeanuw_V2Fltg7U=@mailhog.example', $mail->getMessageId());

        $sender = $mail->getSender();
        $this->assertInstanceOf(Contact::class, $sender);
        $this->assertSame('No Reply Example', $sender->getName());
        $this->assertSame('no-reply@example.org', $sender->getEmailAddress());

        $recipients = $mail->getRecipients();
        $this->assertCount(2, $recipients);
        $this->assertInstanceOf(Contact::class, $recipients[0]);
        $this->assertSame('John Doe', $recipients[0]->getName());
        $this->assertSame('john.doe@gmail.com', $recipients[0]->getEmailAddress());
        $this->assertInstanceOf(Contact::class, $recipients[1]);
        $this->assertSame('Jane Doe', $recipients[1]->getName());
        $this->assertSame('jane.doe@gmail.com', $recipients[1]->getEmailAddress());

        $ccRecipients = $mail->getCcRecipients();
        $this->assertCount(2, $ccRecipients);
        $this->assertInstanceOf(Contact::class, $ccRecipients[0]);
        $this->assertSame('John Doe - Example', $ccRecipients[0]->getName());
        $this->assertSame('john.doe@example.org', $ccRecipients[0]->getEmailAddress());
        $this->assertInstanceOf(Contact::class, $ccRecipients[1]);
        $this->assertSame('Jane Doe - Example', $ccRecipients[1]->getName());
        $this->assertSame('jane.doe@example.org', $ccRecipients[1]->getEmailAddress());

        $bccRecipients = $mail->getBccRecipients();
        $this->assertCount(2, $bccRecipients);
        $this->assertInstanceOf(Contact::class, $bccRecipients[0]);
        $this->assertSame('John Doe', $bccRecipients[0]->getName());
        $this->assertSame('john.doe@gmail.com', $bccRecipients[0]->getEmailAddress());
        $this->assertInstanceOf(Contact::class, $bccRecipients[1]);
        $this->assertSame('Jane Doe', $bccRecipients[1]->getName());
        $this->assertSame('jane.doe@gmail.com', $bccRecipients[1]->getEmailAddress());

        $this->assertSame('Contact', $mail->getSubject());
        $this->assertSame('--0R5oPBDn\r\nContent-Type => text/plain; charset=utf-8\r\nContent-Transfer-Encoding => quoted-printable\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n        \r\n            \r\n                Logo=\r\n\r\n            \r\n        \r\n    \r\n    \r\n        \r\n            Nom\r\n   =\r\n         Alexandre Dumas\r\n        \r\n        \r\n            Type\r\n       =\r\n     recrutement\r\n        \r\n        \r\n            Email\r\n            al=\r\nexandre.dumas@gmail.com\r\n        \r\n        \r\n            Message\r\n     =\r\n       Ceci est un test\r\n        \r\n        \r\n            Date de cr=\r\néation\r\n            16/01/2025 14:28:08\r\n        \r\n    \r\n\r\n\r\n\r\n\r\n--0R5oPBDn\r\nContent-Type => text/html; charset=utf-8\r\nContent-Transfer-Encoding => quoted-printable\r\n\r\n<!DOCTYPE html>\r\n<html>\r\n<head>\r\n    <meta charset=\'UTF-8\'>\r\n    <met=\r\na name=\'viewport\' content=\'width=device-width, initial-scale=1.0\'>=\r\n\r\n    <meta http-equiv=\'content-type\' content=\'text/html\'>\r\n    <titl=\r\ne>Email - Contact</title>\r\n</head>\r\n<body>\r\n<!DOCTYPE html PUBLIC \'-//W3=\r\nC//DTD HTML 4.0 Transitional//EN\' \'http://www.w3.org/TR/REC-html40/loose.dt=\r\nd\'>\r\n<html style=\'font-family => Lato, sans-serif;\'>\r\n<head style=\'font=\r\n-family => Lato, sans-serif;\'>\r\n<link href=\'https://fonts.googleapis.com/c=\r\nss2?family=Lato:wght@400;700&amp;family=Roboto:wght@700&amp;display=s=\r\nwap\' rel=\'stylesheet\' style=\'font-family => Lato, sans-serif;\'>\r\n    <st=\r\nyle style=\'font-family => Lato, sans-serif;\'>\r\n        * [\r\n            f=\r\nont-family => Lato, sans-serif;\r\n        ]\r\n        p [\r\n            color=\r\n => #39BAC1;\r\n        ]\r\n        a, a:hover [\r\n            text-decoration=\r\n => none;\r\n        ]\r\n    </style>\r\n    </head>\r\n<body style=\'font-fami=\r\nly => Lato, sans-serif;\'>\r\n<table width=\'100%\' style=\'font-family => Lato,=\r\n sans-serif;\'>\r\n        <tr style=\'font-family => Lato, sans-serif;\'>\r\n  =\r\n          <td align=\'center\' style=\'font-family => Lato, sans-serif;\'>\r\n=\r\n                Logo\r\n            </td>\r\n        </tr>\r\n    </table>\r\n =\r\n   <table align=\'center\' width=\'50%\' style=\'font-family => Lato, sans-s=\r\nerif;\'>\r\n        <tr align=\'center\' style=\'font-family => Lato, sans-ser=\r\nif;\'>\r\n            <th style=\'font-family => Lato, sans-serif;\'>Nom</th>=\r\n\r\n            <td style=\'font-family => Lato, sans-serif;\'>Alexandre Dumas=\r\n</td>\r\n        </tr>\r\n        <tr align=\'center\' style=\'font-family => =\r\nLato, sans-serif;\'>\r\n            <th style=\'font-family => Lato, sans-seri=\r\nf;\'>Type</th>\r\n            <td style=\'font-family => Lato, sans-serif;\'>re=\r\ncrutement</td>\r\n        </tr>\r\n        <tr align=\'center\' style=\'font=\r\n-family => Lato, sans-serif;\'>\r\n            <th style=\'font-family => Lato, =\r\nsans-serif;\'>Email</th>\r\n            <td style=\'font-family => Lato, sans-=\r\nserif;\'>alexandre.dumas@gmail.com</td>\r\n        </tr>\r\n        <tr align=\r\n=\'center\' style=\'font-family => Lato, sans-serif;\'>\r\n            <th sty=\r\nle=\'font-family => Lato, sans-serif;\'>Message</th>\r\n            <td style=\r\n=\'font-family => Lato, sans-serif;\'>Ceci est un test</td>\r\n        </tr>=\r\n\r\n        <tr align=\'center\' style=\'font-family => Lato, sans-serif;\'>=\r\n\r\n            <th style=\'font-family => Lato, sans-serif;\'>Date de cr=\r\néation</th>\r\n            <td style=\'font-family => Lato, sans-serif;\'=\r\n>16/01/2025 14:28:08</td>\r\n        </tr>\r\n    </table>\r\n</body>\r\n</html=\r\n></body>\r\n</html>\r\n\r\n--0R5oPBDn--\r\n', $mail->getBody());
    }

    /**
     * @return array<string, mixed>
     */
    private function getData(): array
    {
        return [
            'ID' => 'wPysmVJgr1MvNaiE3R91xCc-XtCpHeanuw_V2Fltg7U=@mailhog.example',
            'From' => [
                'Relays' => null,
                'Mailbox' => 'no-reply',
                'Domain' => 'example.org',
                'Params' => ''
            ],
            'To' => [
                [
                    'Relays' => null,
                    'Mailbox' => 'john.doe',
                    'Domain' => 'gmail.com',
                    'Params' => ''
                ],
                [
                    'Relays' => null,
                    'Mailbox' => 'jane.doe',
                    'Domain' => 'gmail.com',
                    'Params' => ''
                ],
                [
                    'Relays' => null,
                    'Mailbox' => 'john.doe',
                    'Domain' => 'example.org',
                    'Params' => ''
                ],
                [
                    'Relays' => null,
                    'Mailbox' => 'jane.doe',
                    'Domain' => 'example.org',
                    'Params' => ''
                ],
                [
                    'Relays' => null,
                    'Mailbox' => 'john.doe',
                    'Domain' => 'yahoo.fr',
                    'Params' => ''
                ],
                [
                    'Relays' => null,
                    'Mailbox' => 'jane.doe',
                    'Domain' => 'yahoo.fr',
                    'Params' => ''
                ]
            ],
            'Content' => [
                'Headers' => [
                    'Cc' => [
                        ' John Doe - Example <john.doe@example.org>,     Jane Doe - Example <jane.doe@example.org>   '
                    ],
                    'Content-Type' => [
                        'multipart/alternative; boundary=0R5oPBDn'
                    ],
                    'Foo' => 'Bar',
                    'Date' => [
                        'Thu, 16 Jan 2025 14:28:08 +0100'
                    ],
                    'From' => [
                        ' No Reply Example <no-reply@example.org>'
                    ],
                    'MIME-Version' => [
                        '1.0'
                    ],
                    'Message-ID' => [
                        '<c687f4e5551526363a47cfb46b14c701@example.org>'
                    ],
                    'Return-Path' => [
                        '<no-reply@example.org>'
                    ],
                    'Subject' => [
                        'Contact'
                    ],
                    'To' => [
                        ' John Doe <john.doe@gmail.com>, Jane Doe <jane.doe@gmail.com>'
                    ],
                    'Bcc' => [
                        ' John Doe <john.doe@gmail.com>, Jane Doe <jane.doe@gmail.com>'
                    ],
                ],
                'Body' => '--0R5oPBDn\r\nContent-Type => text/plain; charset=utf-8\r\nContent-Transfer-Encoding => quoted-printable\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n       =20\r\n           =20\r\n                Logo=\r\n\r\n           =20\r\n       =20\r\n   =20\r\n   =20\r\n       =20\r\n            Nom\r\n   =\r\n         Alexandre Dumas\r\n       =20\r\n       =20\r\n            Type\r\n       =\r\n     recrutement\r\n       =20\r\n       =20\r\n            Email\r\n            al=\r\nexandre.dumas@gmail.com\r\n       =20\r\n       =20\r\n            Message\r\n     =\r\n       Ceci est un test\r\n       =20\r\n       =20\r\n            Date de cr=\r\n=C3=A9ation\r\n            16/01/2025 14:28:08\r\n       =20\r\n   =20\r\n\r\n\r\n\r\n\r\n--0R5oPBDn\r\nContent-Type => text/html; charset=utf-8\r\nContent-Transfer-Encoding => quoted-printable\r\n\r\n<!DOCTYPE html>\r\n<html>\r\n<head>\r\n    <meta charset=3D\'UTF-8\'>\r\n    <met=\r\na name=3D\'viewport\' content=3D\'width=3Ddevice-width, initial-scale=3D1.0\'>=\r\n\r\n    <meta http-equiv=3D\'content-type\' content=3D\'text/html\'>\r\n    <titl=\r\ne>Email - Contact</title>\r\n</head>\r\n<body>\r\n<!DOCTYPE html PUBLIC \'-//W3=\r\nC//DTD HTML 4.0 Transitional//EN\' \'http://www.w3.org/TR/REC-html40/loose.dt=\r\nd\'>\r\n<html style=3D\'font-family => Lato, sans-serif;\'>\r\n<head style=3D\'font=\r\n-family => Lato, sans-serif;\'>\r\n<link href=3D\'https://fonts.googleapis.com/c=\r\nss2?family=3DLato:wght@400;700&amp;family=3DRoboto:wght@700&amp;display=3Ds=\r\nwap\' rel=3D\'stylesheet\' style=3D\'font-family => Lato, sans-serif;\'>\r\n    <st=\r\nyle style=3D\'font-family => Lato, sans-serif;\'>\r\n        * [\r\n            f=\r\nont-family => Lato, sans-serif;\r\n        ]\r\n        p [\r\n            color=\r\n => #39BAC1;\r\n        ]\r\n        a, a:hover [\r\n            text-decoration=\r\n => none;\r\n        ]\r\n    </style>\r\n    </head>\r\n<body style=3D\'font-fami=\r\nly => Lato, sans-serif;\'>\r\n<table width=3D\'100%\' style=3D\'font-family => Lato,=\r\n sans-serif;\'>\r\n        <tr style=3D\'font-family => Lato, sans-serif;\'>\r\n  =\r\n          <td align=3D\'center\' style=3D\'font-family => Lato, sans-serif;\'>\r\n=\r\n                Logo\r\n            </td>\r\n        </tr>\r\n    </table>\r\n =\r\n   <table align=3D\'center\' width=3D\'50%\' style=3D\'font-family => Lato, sans-s=\r\nerif;\'>\r\n        <tr align=3D\'center\' style=3D\'font-family => Lato, sans-ser=\r\nif;\'>\r\n            <th style=3D\'font-family => Lato, sans-serif;\'>Nom</th>=\r\n\r\n            <td style=3D\'font-family => Lato, sans-serif;\'>Alexandre Dumas=\r\n</td>\r\n        </tr>\r\n        <tr align=3D\'center\' style=3D\'font-family => =\r\nLato, sans-serif;\'>\r\n            <th style=3D\'font-family => Lato, sans-seri=\r\nf;\'>Type</th>\r\n            <td style=3D\'font-family => Lato, sans-serif;\'>re=\r\ncrutement</td>\r\n        </tr>\r\n        <tr align=3D\'center\' style=3D\'font=\r\n-family => Lato, sans-serif;\'>\r\n            <th style=3D\'font-family => Lato, =\r\nsans-serif;\'>Email</th>\r\n            <td style=3D\'font-family => Lato, sans-=\r\nserif;\'>alexandre.dumas@gmail.com</td>\r\n        </tr>\r\n        <tr align=\r\n=3D\'center\' style=3D\'font-family => Lato, sans-serif;\'>\r\n            <th sty=\r\nle=3D\'font-family => Lato, sans-serif;\'>Message</th>\r\n            <td style=\r\n=3D\'font-family => Lato, sans-serif;\'>Ceci est un test</td>\r\n        </tr>=\r\n\r\n        <tr align=3D\'center\' style=3D\'font-family => Lato, sans-serif;\'>=\r\n\r\n            <th style=3D\'font-family => Lato, sans-serif;\'>Date de cr=\r\n=C3=A9ation</th>\r\n            <td style=3D\'font-family => Lato, sans-serif;\'=\r\n>16/01/2025 14:28:08</td>\r\n        </tr>\r\n    </table>\r\n</body>\r\n</html=\r\n></body>\r\n</html>\r\n\r\n--0R5oPBDn--\r\n',
                'Size' => 3833,
                'MIME' => null
            ],
            'Created' => '2025-01-16T13:28:08.300229378Z',
            'MIME' => [
                'Parts' => [
                    [
                        'Headers' => [
                            'Content-Transfer-Encoding' => [
                                'quoted-printable'
                            ],
                            'Content-Type' => [
                                'text/plain; charset=utf-8'
                            ]
                        ],
                        'Body' => '\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n       =20\r\n           =20\r\n                Logo=\r\n\r\n           =20\r\n       =20\r\n   =20\r\n   =20\r\n       =20\r\n            Nom\r\n   =\r\n         Alexandre Dumas\r\n       =20\r\n       =20\r\n            Type\r\n       =\r\n     recrutement\r\n       =20\r\n       =20\r\n            Email\r\n            al=\r\nexandre.dumas@gmail.com\r\n       =20\r\n       =20\r\n            Message\r\n     =\r\n       Ceci est un test\r\n       =20\r\n       =20\r\n            Date de cr=\r\n=C3=A9ation\r\n            16/01/2025 14:28:08\r\n       =20\r\n   =20',
                        'Size' => 610,
                        'MIME' => null
                    ],
                    [
                        'Headers' => [
                            'Content-Transfer-Encoding' => [
                                'quoted-printable'
                            ],
                            'Content-Type' => [
                                'text/html; charset=utf-8'
                            ]
                        ],
                        'Body' => '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n    <meta charset=3D\'UTF-8\'>\r\n    <met=\r\na name=3D\'viewport\' content=3D\'width=3Ddevice-width, initial-scale=3D1.0\'>=\r\n\r\n    <meta http-equiv=3D\'content-type\' content=3D\'text/html\'>\r\n    <titl=\r\ne>Email - Contact</title>\r\n</head>\r\n<body>\r\n<!DOCTYPE html PUBLIC \'-//W3=\r\nC//DTD HTML 4.0 Transitional//EN\' \'http://www.w3.org/TR/REC-html40/loose.dt=\r\nd\'>\r\n<html style=3D\'font-family => Lato, sans-serif;\'>\r\n<head style=3D\'font=\r\n-family => Lato, sans-serif;\'>\r\n<link href=3D\'https://fonts.googleapis.com/c=\r\nss2?family=3DLato:wght@400;700&amp;family=3DRoboto:wght@700&amp;display=3Ds=\r\nwap\' rel=3D\'stylesheet\' style=3D\'font-family => Lato, sans-serif;\'>\r\n    <st=\r\nyle style=3D\'font-family => Lato, sans-serif;\'>\r\n        * [\r\n            f=\r\nont-family => Lato, sans-serif;\r\n        ]\r\n        p [\r\n            color=\r\n => #39BAC1;\r\n        ]\r\n        a, a:hover [\r\n            text-decoration=\r\n => none;\r\n        ]\r\n    </style>\r\n    </head>\r\n<body style=3D\'font-fami=\r\nly => Lato, sans-serif;\'>\r\n<table width=3D\'100%\' style=3D\'font-family => Lato,=\r\n sans-serif;\'>\r\n        <tr style=3D\'font-family => Lato, sans-serif;\'>\r\n  =\r\n          <td align=3D\'center\' style=3D\'font-family => Lato, sans-serif;\'>\r\n=\r\n                Logo\r\n            </td>\r\n        </tr>\r\n    </table>\r\n =\r\n   <table align=3D\'center\' width=3D\'50%\' style=3D\'font-family => Lato, sans-s=\r\nerif;\'>\r\n        <tr align=3D\'center\' style=3D\'font-family => Lato, sans-ser=\r\nif;\'>\r\n            <th style=3D\'font-family => Lato, sans-serif;\'>Nom</th>=\r\n\r\n            <td style=3D\'font-family => Lato, sans-serif;\'>Alexandre Dumas=\r\n</td>\r\n        </tr>\r\n        <tr align=3D\'center\' style=3D\'font-family => =\r\nLato, sans-serif;\'>\r\n            <th style=3D\'font-family => Lato, sans-seri=\r\nf;\'>Type</th>\r\n            <td style=3D\'font-family => Lato, sans-serif;\'>re=\r\ncrutement</td>\r\n        </tr>\r\n        <tr align=3D\'center\' style=3D\'font=\r\n-family => Lato, sans-serif;\'>\r\n            <th style=3D\'font-family => Lato, =\r\nsans-serif;\'>Email</th>\r\n            <td style=3D\'font-family => Lato, sans-=\r\nserif;\'>alexandre.dumas@gmail.com</td>\r\n        </tr>\r\n        <tr align=\r\n=3D\'center\' style=3D\'font-family => Lato, sans-serif;\'>\r\n            <th sty=\r\nle=3D\'font-family => Lato, sans-serif;\'>Message</th>\r\n            <td style=\r\n=3D\'font-family => Lato, sans-serif;\'>Ceci est un test</td>\r\n        </tr>=\r\n\r\n        <tr align=3D\'center\' style=3D\'font-family => Lato, sans-serif;\'>=\r\n\r\n            <th style=3D\'font-family => Lato, sans-serif;\'>Date de cr=\r\n=C3=A9ation</th>\r\n            <td style=3D\'font-family => Lato, sans-serif;\'=\r\n>16/01/2025 14:28:08</td>\r\n        </tr>\r\n    </table>\r\n</body>\r\n</html=\r\n></body>\r\n</html>',
                        'Size' => 2764,
                        'MIME' => null
                    ],
                    [
                        'Headers' => [],
                        'Body' => '--',
                        'Size' => 2,
                        'MIME' => null
                    ]
                ]
            ],
            'Raw' => [
                'From' => 'no-reply@example.org',
                'To' => [
                    'john.doe@gmail.com',
                    'jane.doe@gmail.com',
                    'john.doe@example.org',
                    'jane.doe@example.org',
                    'john.doe@yahoo.fr',
                    'jane.doe@yahoo.fr'
                ],
                'Data' => 'From => No Reply Example <no-reply@example.org>\r\nTo => John Doe <john.doe@gmail.com>, Jane Doe <jane.doe@gmail.com>\r\nCc => John Doe - Example <john.doe@example.org>, Jane Doe - Example\r\n <jane.doe@example.org>\r\nSubject => Contact\r\nMessage-ID => <c687f4e5551526363a47cfb46b14c701@example.org>\r\nMIME-Version => 1.0\r\nDate => Thu, 16 Jan 2025 14:28:08 +0100\r\nContent-Type => multipart/alternative; boundary=0R5oPBDn\r\n\r\n--0R5oPBDn\r\nContent-Type => text/plain; charset=utf-8\r\nContent-Transfer-Encoding => quoted-printable\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n       =20\r\n           =20\r\n                Logo=\r\n\r\n           =20\r\n       =20\r\n   =20\r\n   =20\r\n       =20\r\n            Nom\r\n   =\r\n         Alexandre Dumas\r\n       =20\r\n       =20\r\n            Type\r\n       =\r\n     recrutement\r\n       =20\r\n       =20\r\n            Email\r\n            al=\r\nexandre.dumas@gmail.com\r\n       =20\r\n       =20\r\n            Message\r\n     =\r\n       Ceci est un test\r\n       =20\r\n       =20\r\n            Date de cr=\r\n=C3=A9ation\r\n            16/01/2025 14:28:08\r\n       =20\r\n   =20\r\n\r\n\r\n\r\n\r\n--0R5oPBDn\r\nContent-Type => text/html; charset=utf-8\r\nContent-Transfer-Encoding => quoted-printable\r\n\r\n<!DOCTYPE html>\r\n<html>\r\n<head>\r\n    <meta charset=3D\'UTF-8\'>\r\n    <met=\r\na name=3D\'viewport\' content=3D\'width=3Ddevice-width, initial-scale=3D1.0\'>=\r\n\r\n    <meta http-equiv=3D\'content-type\' content=3D\'text/html\'>\r\n    <titl=\r\ne>Email - Contact</title>\r\n</head>\r\n<body>\r\n<!DOCTYPE html PUBLIC \'-//W3=\r\nC//DTD HTML 4.0 Transitional//EN\' \'http://www.w3.org/TR/REC-html40/loose.dt=\r\nd\'>\r\n<html style=3D\'font-family => Lato, sans-serif;\'>\r\n<head style=3D\'font=\r\n-family => Lato, sans-serif;\'>\r\n<link href=3D\'https://fonts.googleapis.com/c=\r\nss2?family=3DLato:wght@400;700&amp;family=3DRoboto:wght@700&amp;display=3Ds=\r\nwap\' rel=3D\'stylesheet\' style=3D\'font-family => Lato, sans-serif;\'>\r\n    <st=\r\nyle style=3D\'font-family => Lato, sans-serif;\'>\r\n        * [\r\n            f=\r\nont-family => Lato, sans-serif;\r\n        ]\r\n        p [\r\n            color=\r\n => #39BAC1;\r\n        ]\r\n        a, a:hover [\r\n            text-decoration=\r\n => none;\r\n        ]\r\n    </style>\r\n    </head>\r\n<body style=3D\'font-fami=\r\nly => Lato, sans-serif;\'>\r\n<table width=3D\'100%\' style=3D\'font-family => Lato,=\r\n sans-serif;\'>\r\n        <tr style=3D\'font-family => Lato, sans-serif;\'>\r\n  =\r\n          <td align=3D\'center\' style=3D\'font-family => Lato, sans-serif;\'>\r\n=\r\n                Logo\r\n            </td>\r\n        </tr>\r\n    </table>\r\n =\r\n   <table align=3D\'center\' width=3D\'50%\' style=3D\'font-family => Lato, sans-s=\r\nerif;\'>\r\n        <tr align=3D\'center\' style=3D\'font-family => Lato, sans-ser=\r\nif;\'>\r\n            <th style=3D\'font-family => Lato, sans-serif;\'>Nom</th>=\r\n\r\n            <td style=3D\'font-family => Lato, sans-serif;\'>Alexandre Dumas=\r\n</td>\r\n        </tr>\r\n        <tr align=3D\'center\' style=3D\'font-family => =\r\nLato, sans-serif;\'>\r\n            <th style=3D\'font-family => Lato, sans-seri=\r\nf;\'>Type</th>\r\n            <td style=3D\'font-family => Lato, sans-serif;\'>re=\r\ncrutement</td>\r\n        </tr>\r\n        <tr align=3D\'center\' style=3D\'font=\r\n-family => Lato, sans-serif;\'>\r\n            <th style=3D\'font-family => Lato, =\r\nsans-serif;\'>Email</th>\r\n            <td style=3D\'font-family => Lato, sans-=\r\nserif;\'>alexandre.dumas@gmail.com</td>\r\n        </tr>\r\n        <tr align=\r\n=3D\'center\' style=3D\'font-family => Lato, sans-serif;\'>\r\n            <th sty=\r\nle=3D\'font-family => Lato, sans-serif;\'>Message</th>\r\n            <td style=\r\n=3D\'font-family => Lato, sans-serif;\'>Ceci est un test</td>\r\n        </tr>=\r\n\r\n        <tr align=3D\'center\' style=3D\'font-family => Lato, sans-serif;\'>=\r\n\r\n            <th style=3D\'font-family => Lato, sans-serif;\'>Date de cr=\r\n=C3=A9ation</th>\r\n            <td style=3D\'font-family => Lato, sans-serif;\'=\r\n>16/01/2025 14:28:08</td>\r\n        </tr>\r\n    </table>\r\n</body>\r\n</html=\r\n></body>\r\n</html>\r\n\r\n--0R5oPBDn--\r\n',
                'Helo' => '[127.0.0.1]'
            ]
        ];
    }
}
