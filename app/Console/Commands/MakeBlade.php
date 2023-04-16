<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeBlade extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:blade {name} {--dir=} {--type=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a demo blade layout! {--dir=: blade template directory} {--type=:blade type like(index) func.}';

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
        // file name
        $file_name = $this->argument('name');
        $dir = $this->option('dir');

        // if not set the director then ask for dir
        if(!$dir) {
           $dir = $this->ask('What is your directory in views folder?');
        }
        // get file type like - |index,create,edit,view|
        $type = $this->option('type');
        if(!$type) {
            if($this->confirm('Do you want to set blade type?', false)) {
                $type = $this->choice('What is your blade type?', [
                    0 => 'index', 
                    1 => 'create', 
                    2=> 'edit', 
                    3=> 'view'
                ], 0);
            }
        }

        $this->newLine();

        $full_file_name = app_path()."/../resources/views/".$dir."/".$file_name.".blade.php";
        // our demo template link
        $demo_file_name = app_path()."/../resources/views/demo/demo.blade.txt";
        // if demo file not exist then return a warning for create demo file
        if(!file_exists($demo_file_name)) {
            $this->error("Demo File Not Found. Please create a demo file named \"demo.blade.txt\" inside \"views/demo\" directory.");;
            return 0;
        }

        // create type based file
        if($type == 'index' || $type == "view") {
            $demo_table_file = app_path()."/../resources/views/demo/table.blade.txt";
            if(!file_exists($demo_table_file)) {
                $this->error("File not found. Please create a demo file named \"table.blade.txt\" inside \"views/demo\" directory.");;
            }else {
                $demo_file_name = str_replace(
                    "{{content}}", 
                    file_get_contents(app_path()."/../resources/views/demo/table.blade.txt"), 
                    file_get_contents($demo_file_name)
                );
            }
        }elseif($type == 'create' || $type == "edit") {
            $demo_table_file = app_path()."/../resources/views/demo/form.blade.txt";
            if(!file_exists($demo_table_file)) {
                $this->error("File not found. Please create a demo file named \"form.blade.txt\" inside \"views/demo\" directory.");;
            }else {
                $demo_file_name = str_replace(
                    "{{content}}", 
                    file_get_contents(app_path()."/../resources/views/demo/form.blade.txt"), 
                    file_get_contents($demo_file_name)
                );
            }
        } else {
            $demo_file_name = str_replace("{{content}}", "", file_get_contents($demo_file_name));
        }

        if(file_exists($full_file_name)) {
            $this->warn($dir.$file_name.".blade.php blade template already created!");;
            return 0;
        } 
        else {
            // if not found directory then create directory
            if(!file_exists(app_path()."/../resources/views/".$dir)) {
                if(!mkdir(app_path()."/../resources/views/".$dir)) {
                    $this->error("Failed to create this ".$dir . " directory. Please create manually this directory!");
                    return 0;
                }
            }

            if(!file_put_contents($full_file_name, $demo_file_name)) {
                $this->warn("Unable to create blade file");
                return 0;
            }
        }

        $this->info("Create successfully ". $file_name . ".blade.php file inside your " . $dir . " directory!");
        return 0;
    }
}
