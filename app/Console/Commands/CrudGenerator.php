<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class CrudGenerator extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud {model} {--table=} {--dir=pages}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate CRUD including migration,model,controller, view by model name';

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
        $model = $this->argument('model');
        $table = $this->option('table');
        $dir = $this->option('dir');

        $lowerModel = Str::lower($model);
        if($table == '') {
            $table = Str::plural($lowerModel);
        }

        // create a migrations
        $migrate = $this->call('make:migration', [
            'name' => "create_" . $table . "_table"
        ]);

        // make a model
        $model_ = $this->call("make:model", [
            'name' => $model
        ]);

        // make a controller
        $controller = $this->call("make:controller", [
            'name' => $model . "Controller",
            '--model' => $model
        ]);

        // index demo blade file
        $index_demo = app_path()."/../resources/views/demo/crud/index.blade.txt";
        // create demo blade file
        $create_demo = app_path()."/../resources/views/demo/crud/create.blade.txt";
        // create demo blade file
        $edit_demo = app_path()."/../resources/views/demo/crud/edit.blade.txt";
        // create demo blade file
        $view_demo = app_path()."/../resources/views/demo/crud/view.blade.txt";

        $folder_dir = app_path()."/../resources/views/" . $dir . "/" . $lowerModel;
        if(!file_exists($folder_dir)) {
            if(!mkdir($folder_dir)) {
                $this->error("Failed to create this ".$dir . " directory. Please create manually this directory!");
            }
        }

        $index_file_content = str_replace(
            "{{model}}",
            Str::lower($model),
            file_get_contents($index_demo)
        );

        $create_file_content = str_replace(
            "{{model}}",
            Str::lower($model),
            file_get_contents($create_demo)
        );

        $edit_file_content = str_replace(
            "{{model}}",
            Str::lower($model),
            file_get_contents($edit_demo)
        );

        $view_file_content = str_replace(
            "{{model}}",
            Str::lower($model),
            file_get_contents($view_demo)
        );

        $index = app_path()."/../resources/views/" . $dir . "/" . $lowerModel . "/index.blade.php";
        $create = app_path()."/../resources/views/" . $dir . "/" . $lowerModel . "/create.blade.php";
        $edit = app_path()."/../resources/views/" . $dir . "/" . $lowerModel . "/edit.blade.php";
        $view = app_path()."/../resources/views/" . $dir . "/" . $lowerModel . "/view.blade.php";

        if(!file_put_contents($index, $index_file_content)) {
            $this->warn("Unable to create index file");
        }

        if(!file_put_contents($create, $create_file_content)) {
            $this->warn("Unable to create create file");
        }

        if(!file_put_contents($edit, $edit_file_content)) {
            $this->warn("Unable to create edit file");
        }

        if(!file_put_contents($view, $view_file_content)) {
            $this->warn("Unable to create view file");
        }

        $this->info("CRUD created successfull for " . $model);

        return 0;
    }
}
