<?php

namespace Egately\EgateAuthClient\Commands;

use Illuminate\Console\Command;

class EgateAuthClientCommand extends Command
{
    public $signature = 'egauthclient';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
