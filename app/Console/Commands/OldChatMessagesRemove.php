<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Message;

class OldChatMessagesRemove extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat:message:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $msg = new Message();
        $msg->removeChatMessages();
        $msg->removeChatMedia();
    }
}
