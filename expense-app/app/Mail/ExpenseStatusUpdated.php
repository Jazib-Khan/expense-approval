<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExpenseStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $userEmail, $status, $amount, $category, $description, $employeeEmail;

    /**
     * Create a new message instance.
     */
    public function __construct($userEmail, $status, $category, $description, $amount, $employeeEmail)
    {
        $this->userEmail = $userEmail;
        $this->status = $status;
        $this->category = $category;
        $this->description = $description;
        $this->amount = $amount;
        $this->employeeEmail = $employeeEmail;
    }

    public function build()
    {
        return $this->from($this->userEmail)
                    ->subject('Expense Request ' . ucfirst($this->status))
                    ->view('emails.expense-status-updated');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Expense Status Updated',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.expense-status-updated',
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
