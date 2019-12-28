<?php

namespace App\Console\Commands;

use App\Models\TempNewContact;
use App\Models\User;
use Illuminate\Console\Command;

class SyncUserContact extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:user:contact';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync temp contacts to main';

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
//        $this->info($this->description);
//        $contacts = TempNewContact::all();
//        foreach ($contacts as $contact) {
//            $this->info("Building {$contact->phone_number}!");
//            $model = new User();
//            try {
//                $model->syncContact($contact);
//            } catch (\Exception $e) {
//                continue;
//            }
//        }

        ini_set('memory_limit', '-1');
        $model = new User();

        $contacts = $model->getUserTempContacts();
        $ids = 0;
        foreach ($contacts as $contact) {
            try {
                $ids = $contact->id;
                $model->syncContact($contact);
            } catch (\Exception $e) {
                continue;
            }
        }

        $model->removeSelectedUserTempContacts($ids);
//        TempContact::truncate();
    }
}
