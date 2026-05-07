<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WithdrawalRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public $withdrawal, public $isAdmin = false)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = $this->isAdmin ? 'New Withdrawal Request Received' : 'We Received Your Withdrawal Request';
        return new Envelope(subject: $subject);
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Logic to format display
        $displayAmount = $this->withdrawal->withdrawal_method === 'car'
            ? $this->withdrawal->amount . ' Unit(s)'
            : '$' . number_format($this->withdrawal->amount, 2);

        return new Content(
            view: 'emails.withdrawals.requested',
            with: [
                'displayAmount' => $displayAmount,
                'method' => strtoupper($this->withdrawal->withdrawal_method)
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
