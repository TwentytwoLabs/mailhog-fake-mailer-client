<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Client;

use TwentytwoLabs\BehatFakeMailerExtension\Factory\MailhogMailFactory;

final class MailhogClient extends AbstractClient
{
    public function purgeMessages(): void
    {
        $this->client->request('DELETE', sprintf('%s/api/v1/messages', $this->baseUrl));
    }

    public function findMessages(array $specifications): array
    {
        $offset = 0;
        $limit = 50;
        $mails = [];

        do {
            $response = $this->client->request(
                'GET',
                sprintf('%s/api/v2/messages?start=%s&limit=%s', $this->baseUrl, $offset, $limit)
            );
            $messages = $response->toArray();
            foreach ($messages['items'] as $message) {
                $mail = MailhogMailFactory::createMail($message);
                if ($this->isMatching($specifications, $mail)) {
                    $mails[] = $mail;
                }
            }
            $offset += $limit;
        } while ($offset < ($messages['total'] ?? 0));

        return $mails;
    }
}
