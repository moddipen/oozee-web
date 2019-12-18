<?php

namespace App\Console\Commands;

use App\Models\TempContact;
use App\Models\User;
use App\Models\CronContact;
use Illuminate\Console\Command;

class SyncContact extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:contact';

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
        ini_set('memory_limit', '-1');
        $model = new User();
        $cron = CronContact::find(1);
        if($cron) {
            $contacts = TempContact::where('id', '>', $cron->contact_id)->limit(50000)->get();
        } else {
            $cron = new CronContact();
            $contacts = TempContact::limit(50000)->get();
        }
        $cron->contact_id = $contacts[count($contacts) - 1]->id;
        $cron->save();
        foreach ($contacts as $contact) {
            try {
                $model->syncContact($contact);
            } catch (\Exception $e) {
                continue;
            }
        }
//        TempContact::truncate();
    }
}
