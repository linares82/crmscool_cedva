<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Eloquent;
use DB;
use App\Empleado;
use App\Cliente;
use Auth;

class Imap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imap:accion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Conecta con base de datos remota y carga clientes de forma automatica';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /*
        $client = new Client(array(
            'host'=>'imap.gmail.com',
            'port' => 993,
            'encryption' => 'ssl', // Supported: false, 'ssl', 'tls'
            'validate_cert' => true,
            'username' => 'linares82@gmail.com',
            'password' => 'olmec8212lemon.',
        ));*/
        $mailbox = new \PhpImap\Mailbox('{imap.gmail.com:993/imap/ssl}INBOX', 'linares82@gmail.com', 'olmec8212lemon.', __DIR__);

        // Read all messaged into an array:
        $mailsIds = $mailbox->searchMailbox('ALL');
        if(!$mailsIds) {
                die('Mailbox is empty');
        }

        // Get the first message and save its attachment(s) to disk:
        //dd(count($mailsIds));
        $mail = $mailbox->getMail($mailsIds[7259]);
        dd($mail);
        
        /*/print_r($mail);
        echo "\n\nAttachments:\n";
        print_r($mail->getAttachments()); 
         * 
         */
    }

    
}
