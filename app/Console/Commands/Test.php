<?php
 namespace App\Console\Commands;

use Mail;
use Illuminate\Console\Command;

class Test extends Command {

    protected $name = 'test';

    protected $description = 'This is a test.';

    public function __construct()
    {
        parent::__construct();
    }

    public function fire()
    {
        Mail::send('emails.test', [], function($message)
        {
            $message->to('rithymok33@outlook.com', 'John Doe')->subject('Test');
        });

        $this->info('Test has fired.');
    }
}