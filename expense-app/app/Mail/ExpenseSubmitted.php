<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExpenseSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $userEmail, $description, $amount, $category;

    /**
     * Create a new message instance.
     */
    public function __construct($userEmail, $description, $amount, $category)
    {
        $this->userEmail = $userEmail;
        $this->description = $description;
        $this->amount = $amount;
        $this->category = $category;
    }

    public function build()
    {
        return $this->from($this->userEmail)
                    ->subject('New Expense Submitted')
                    ->view('emails.expense-submitted');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Expense Submitted',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.expense-submitted',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
