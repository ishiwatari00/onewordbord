<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    
    /**
     * Create a new message instance.
     */
    public function __construct(public $urldata)
    {
       
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope   //件名、送信者、返信先
    {
        return new Envelope(
            subject: '仮登録完了のお知らせ',
            from: 'hello@example.net',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content    //本文設定　bladeで作成
    {
        return new Content(
            view: 'emails.emailtemp',
            with: [
                'url' => $this->urldata['url']
            ],
            
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array        //添付ファイル
    {
        return [];
    }
}
