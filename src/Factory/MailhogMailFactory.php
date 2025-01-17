<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Factory;

use TwentytwoLabs\BehatFakeMailerExtension\Model\Contact;
use TwentytwoLabs\BehatFakeMailerExtension\Model\Mail;
use TwentytwoLabs\BehatFakeMailerExtension\Model\Mailhog\Headers;
use TwentytwoLabs\BehatFakeMailerExtension\Model\Mailhog\MimePartCollection;

final class MailhogMailFactory
{
    /**
     * @param array<string, mixed> $data
     */
    public static function createMail(array $data): Mail
    {
        $mimeParts = MimePartCollection::fromResponse($data['MIME']['Parts'] ?? []);
        $headers = Headers::fromResponse($data);
        $body = !$mimeParts->isEmpty() ? $mimeParts->getBody() : self::decodeBody($headers, $data['Content']['Body']);

        $mail = new Mail();
        $mail
            ->setMessageId($data['ID'])
            ->setSender(Contact::fromString($headers->get('from')))
            ->setRecipients(array_map(
                fn (string $recipient) => Contact::fromString($recipient),
                explode(', ', $headers->get('to'))
            ))
            ->setCcRecipients(array_map(
                fn (string $recipient) => Contact::fromString($recipient),
                !empty($headers->get('cc')) ? explode(', ', $headers->get('cc')) : []
            ))
            ->setBccRecipients(array_map(
                fn (string $recipient) => Contact::fromString($recipient),
                !empty($headers->get('bcc')) ? explode(', ', $headers->get('bcc')) : []
            ))
            ->setSubject($headers->get('subject'))
            ->setBody($body)
        ;

        return $mail;
    }

    private static function decodeBody(Headers $headers, string $body): string
    {
        if ($headers->get('Content-Transfer-Encoding') === 'quoted-printable') {
            return quoted_printable_decode($body);
        }

        return $body;
    }
}
