<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SynchSheetContacts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:sheet:contact';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync sheet temp contacts to main';

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
        ini_set('memory_limit', '-1');
        $model = new User();
        $contacts = $model->getSheetTempContacts();
        $ids = 0;
        foreach ($contacts as $contact) {
            try {
                $ids = $contact->id;
                $model->syncContact($contact);
            } catch (\Exception $e) {
                continue;
            }
        }
        $model->removeSelectedSheetTempContacts($ids);
    }
}
