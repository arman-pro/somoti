<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TranslateColumnAdd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translate:add {column} {--short=no}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Translatable Column to translatable file for localization';

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
        // column name
        $item = $this->argument('column');

        // if need to short
        $short = $this->option('short');

        $translatable = app_path() . "/../resources/lang/translatable.json";
        if(file_exists($translatable)) {
            $data = json_decode(file_get_contents($translatable));
            $columns = $data->columns;
            if(in_array($item, $columns)) {
                $this->warn('Already exists this column!');
                return 0;
            }
            array_push($columns, $item);
            if($short == "yes") {
                sort($columns, SORT_STRING);
            }
            $data->columns = $columns;
            $size = file_put_contents($translatable, json_encode($data));
            $this->info('Column added! Size:- ' . $size);
            return 0;
        }
        $this->warn("Please create a file resources/lang/translatable.json");
        return 0;
    }
}
