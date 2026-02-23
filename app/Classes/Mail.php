<?php

namespace App\Classes;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class Mail extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Mail constructor.
     * @param array $recipients
     * @param array $cCRecipients
     * @param array $bCCRecipients
     * @param array $attachments
     * @param string $subject
     * @param string $body
     * @param string $actionURL
     * @param string $actionText
     * @param string $greeting
     * @param string $thanks
     */
    public function __construct(
        protected array $recipients = [],
        protected array $cCRecipients = [],
        protected array $bCCRecipients = [],
        protected array $attachments = [],
        protected string $subject = "",
        protected string $body = "",
        protected string $actionURL = "",
        protected string $actionText = "",
        protected string $greeting = "",
        protected string $thanks = "")
    {
    }

    /**
     * @param array $recipients
     * @return Mail
     */
    public function setRecipients(array $recipients): Mail
    {
        $this->recipients = $recipients;
        return $this;
    }

    /**
     * @param array $cCRecipients
     * @return Mail
     */
    public function setCCRecipients(array $cCRecipients): Mail
    {
        $this->cCRecipients = $cCRecipients;
        return $this;
    }

    /**
     * @param array $bCCRecipients
     * @return Mail
     */
    public function setBCCRecipients(array $bCCRecipients): Mail
    {
        $this->bCCRecipients = $bCCRecipients;
        return $this;
    }

    /**
     * @param array $attachments
     * @return Mail
     */
    public function setAttachments(array $attachments): Mail
    {
        $this->attachments = $attachments;
        return $this;
    }

    /**
     * @param string $subject
     * @return Mail
     */
    public function setSubject(string $subject): Mail
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @param string $body
     * @return Mail
     */
    public function setBody(string $body): Mail
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return array
     */
    public function getRecipients(): array
    {
        return $this->recipients;
    }

    /**
     * @return array
     */
    public function getCCRecipients(): array
    {
        return $this->cCRecipients;
    }

    /**
     * @return array
     */
    public function getBCCRecipients(): array
    {
        return $this->bCCRecipients;
    }

    /**
     * @return array
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    public function via($notifiable): array
    {
        return ['mail', 'database']; // Choisissez les canaux de notification souhaités
    }

    public function toMail($notifiable): MailMessage
    {
        $email = new MailMessage();

        foreach ($this->getRecipients() as $recipient) {
            $email->replyTo($recipient);
        }
        foreach ($this->getBCCRecipients() as $recipient) {
            $email->bcc($recipient);
        }
        foreach ($this->getCCRecipients() as $recipient) {
            $email->cc($recipient);
        }
        foreach ($this->getAttachments() as $file) {
            $email->attach($file);
        }

        $subject = $this->getSubject();

        $email->subject($subject);
        $email->line(new HtmlString($this->getBody()));

        if($this->actionText != "" && $this->actionURL != "")
            $email->action($this->actionText, $this->actionURL);

        $email->greeting(new HtmlString($this->greeting));
        $email->line(new HtmlString($this->thanks));

        return $email;
    }

    public function toDatabase($notifiable): array
    {
        return [
            'message' => $this->body,
        ];
    }
}
