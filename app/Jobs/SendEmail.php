<?php

namespace App\Jobs;

use Mail;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $email_details;
    public $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email_details)
    {
        $this->email = $email_details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mail $mailer)
    {
      try {
        if (config('services.hoseh_services.send_email')) {
          $send_email = $this->email;
          if ($send_email['type'] == 'registration') {
            $mailer::send($send_email['template'], ['user' => $send_email['user']], function ($m) use ($send_email) {
                    $m->from(config('services.hoseh_services.sender_email'), $send_email['from']);
                    $m->to($send_email['user']->email, $send_email['user']->first_name . ' ' . $send_email['user']->last_name)
                    ->subject($send_email['subject']);
                  });
          }
          elseif ($send_email['type'] == 'purchase') {
            $mailer::send($send_email['template'], ['purchase' => $send_email['purchase']], function ($m) use ($send_email) {
                  $m->from(config('services.hoseh_services.sender_email'), $send_email['from']);
                  $m->to($send_email['purchase']['user']->email, $send_email['purchase']['user']->first_name . ' ' . $send_email['purchase']['user']->last_name)
                  ->subject($send_email['subject']);
                });
          }
          elseif ($send_email['type'] == 'winner') {
            $mailer::send($send_email['template'], ['purchase' => $send_email['winner']], function ($m) use ($send_email) {
                  $m->from(config('services.hoseh_services.sender_email'), $send_email['from']);
                  $m->to($send_email['winner_email'], $send_email['winner_name'])
                  ->subject($send_email['subject']);
                });
          }
          elseif ($send_email['type'] == 'non-winner') {
            $mailer::send($send_email['template'], ['purchase' => $send_email['non_winner']], function ($m) use ($send_email) {
                  $m->from(config('services.hoseh_services.sender_email'), $send_email['from']);
                  $m->to($send_email['non_winner_email'], $send_email['non_winner_name'])
                  ->subject($send_email['subject']);
                });
          }
        }
      }
      catch (Exception $e) {

      }
    }
}
