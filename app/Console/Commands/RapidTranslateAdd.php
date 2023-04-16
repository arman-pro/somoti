<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RapidTranslateAdd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translate:rapidly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Multiple Translatable Column to translatable file for localization Rapidly!';

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
     * @return int
     */
    public function handle()
    {
        $this->info('Please type "stop" for stop!');

        $translatable = app_path() . "/../resources/lang/translatable.json";
        if(file_exists($translatable)) {
            $data = json_decode(file_get_contents($translatable));
            $columns = $data->columns;
        }else {
            $this->info("translatable.json file not found!");
            return 0;
        }

        $column = $this->ask("Type Column Name: ");
        while($column != "stop") {
            if($column == "stop") {
                return 0;
            }
            if(in_array($column, $columns)) {
                $this->warn('Already exists this column!');
            }else {
                array_push($columns, $column);
                $this->info("Added: " . $column);
            }
            $column = $this->ask("Type Column Name: ");
        }

        $data->columns = $columns;
        $size = file_put_contents($translatable, json_encode($data));
        $this->info('Columns added & exit! size - ' . $size);
        return 0;
    }
}
