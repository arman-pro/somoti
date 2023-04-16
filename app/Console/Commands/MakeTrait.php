<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeTrait extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:trait {trait}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a New Tarit!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    // /**
    //  * Execute the console command.
    //  *
    //  * @return int
    //  */
    public function handle()
    {
        $trait_name = $this->argument('trait');
        // create a new file
        $class_file_name = app_path().'/Traits/'.$trait_name.".php";

        if(file_exists($class_file_name)) {
            $this->warn($trait_name." Already Created!");
            return 0;
        } else {
            // get demo file
            $demo_file = file_get_contents(app_path().'/../stubs/trait.stub');
            // replace this class Name
            $new_class = str_replace("DummyTrait", $this->argument('trait'), $demo_file);
            if(!file_put_contents($class_file_name, $new_class)) {
                $this->warn("Unable to create Trait Class");
                return 0;
            }
        }
        $this->info($trait_name . " Create Successfully");
        return 0;
    }
}
