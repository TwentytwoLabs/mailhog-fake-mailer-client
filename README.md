Mailhog fake mailer
================

This package provide [Mailhog](https://github.com/mailhog/MailHog) support for TwentytwoLabs's [BehatFakeMailerExtension](https://github.com/TwentytwoLabs/behat-fake-mailer-extension)

## Installation

To install the package, use composer:

```
composer require twentytwo-labs/mailhog-fake-mailer-client
```

## Usage

In your `behat.yaml`

```yaml
default:
  suites:
    # your suite configuration here
  extensions:
   TwentytwoLabs\BehatFakeMailerExtension:
      base_url: http://localhost:8025 # optional, defaults to 'http://localhost:8025'
      client: 'mailhog'
```
