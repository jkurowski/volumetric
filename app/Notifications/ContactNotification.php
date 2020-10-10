<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ContactNotification extends Notification
{
    use Queueable;

    private $request;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Formularz kontaktowy - nowa wiadomość')
                    ->greeting('Witaj!')
                    ->line($this->request->input('name'). ' wysłał wiadomość dnia '.date('Y:m:d H:i'))
                    ->line('E-mail: '.$this->request->input('email'))
                    ->line(new HtmlString('Wiadomość: '.new HtmlString('<br>').$this->request->input('message')));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'name' => $this->request->input('name'),
            'email' => $this->request->input('email'),
            'message' => $this->request->input('message'),
            'subject' => $this->request->input('subject'),
            'ip' => $this->request->ip(),
            'url' => $this->request->headers->get('referer'),
            'page' => $notifiable->name
        ];
    }
}
