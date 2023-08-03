<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class Newsletter
{
    private ?ApiClient $mailchimp = null;

    public function subscribe(string $email, string $list = null)
    {
        $list ??= config( 'services.mailchimp.lists.subscribers');
        $this->getMailchimp()->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => config('services.mailchimp.prefix'),
        ]);


        return $this->getMailchimp()->lists->addListMember($list, [
            'email_address' => $email,
            'status'        => 'subscribed'  // subscribed, unsubscribed, cleaned, pending, transactional
        ]);
    }

    public function getMailchimp() : ApiClient
    {
        if ( !$this->mailchimp) {
            $this->mailchimp = new ApiClient();
        }
        return $this->mailchimp;
    }
}