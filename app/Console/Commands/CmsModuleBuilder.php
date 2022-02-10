<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\DefaultCrudTables;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

require 'app/Http/Services/Services_JSON.php';

class CmsModuleBuilder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $tableName = "";
    protected $tableCameledName = "";
    protected $signature = 'cms {table_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create CMS module';

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
        $this->tableName = $this->argument('table_name');
        $this->tableCameledName = Str::camel($this->tableName);

        $this->createController();
        $this->createModel();
        $this->addToDefaultCrudTables();
        $this->createTable();
        $this->createPanelForm();
        $this->createCmsRoutes();
    }

    public function createFile(array $options)
    {
        $newFilePath = $options['newFilePath'];

        if (file_exists($newFilePath)) return;

        $exampleFile = file_get_contents($options['exampleFilePath']);
        $content = str_replace($options['replaceSearch'], $options['replaceValues'], $exampleFile);

        $newFile = fopen($newFilePath, "w");
        fwrite($newFile, $content);
        fclose($newFile);
    }
    public function createController()
    {
        $newControllerName = ucfirst("{$this->tableCameledName}Controller");

        $this->createFile([
            'exampleFilePath' => __DIR__ . "/../../Http/Controllers/ExampleController.php",
            'newFilePath' => __DIR__ . "/../../Http/Controllers/{$newControllerName}.php",
            "replaceSearch" => ['ExampleController'],
            "replaceValues" => [$newControllerName]
        ]);
    }

    public function createModel()
    {
        $newModelName = ucfirst("{$this->tableCameledName}");

        $this->createFile([
            'exampleFilePath' => __DIR__ . "/../../Example.php",
            'newFilePath' => __DIR__ . "/../../{$newModelName}.php",
            "replaceSearch" => ['Example', "{table}"],
            "replaceValues" => [$newModelName, $this->tableName]
        ]);
    }
    public function addToDefaultCrudTables()
    {
        $defaultCrudTables = DefaultCrudTables::find(1);
        $tables = json_decode($defaultCrudTables->json);
        $tables[] = $this->tableName;
        $tables = array_unique($tables);
        $defaultCrudTables->json = json_encode($tables);
        $defaultCrudTables->save();
    }

    public function createTable()
    {
        if (Schema::hasTable($this->tableName)) return;
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(false)->nullable();
            $table->integer('order_number')->nullable();
            $table->text('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->text('button_name')->nullable();
            $table->text('link')->nullable();
            $table->text('photo')->nullable();
            $table->text('photo_alt')->nullable();
            $table->timestamps();
        });
    }

    public function createPanelForm()
    {
        $newPanelFormName = ucfirst("{$this->tableCameledName}");

        $this->createFile([
            'exampleFilePath' => __DIR__ . "/../../../resources/js/views/admin/forms/Example.vue",
            'newFilePath' => __DIR__ . "/../../../resources/js/views/admin/forms/{$newPanelFormName}.vue",
            "replaceSearch" => ['{title}'],
            "replaceValues" => [$newPanelFormName]
        ]);
    }

    public function createCmsRoutes()
    {
        $cmsRoutesPath = __DIR__ . "/../../../resources/js/router/cmsRoutes.js";
        $cmsRoutes = file_get_contents($cmsRoutesPath);

        $formName = ucfirst("{$this->tableCameledName}");

        $lines = explode(';', $cmsRoutes);
        $imports = array_filter($lines, function ($item) {
            return strpos($item, 'import') !== FALSE;
        });
        $imports = array_map(function ($import) {
            return preg_replace('/\n/', '', $import);
        }, $imports);

        $exportDefault = array_values(array_filter($lines, function ($item) {
            return strpos($item, 'export default') !== FALSE;
        }))[0];

        $exportDefault = preg_replace('/\s+/', '', $exportDefault);


        preg_match('/\[(.*?)\]/', $exportDefault, $stringModules);

        $json = new \Services_JSON(16);
        $modules = $json->decode("[{$stringModules[1]}]");


        $componentPath = "\"@/views/admin/forms/{$formName}.vue\"";

        if (empty(array_filter($imports, function ($import) use ($formName) {
            return strpos($import, $formName) !== FALSE;
        }))) $imports[] = "import $formName from $componentPath";


        if (empty(array_filter($modules, function ($module) use ($formName) {
            return $module['route-name'] == $formName;
        }))) array_push($modules, ['route-name' => $formName, 'component-name' => $formName, 'component-path' => "/admin-panel/{$this->tableName}/form"], ['route-name' => "{$formName}Edit", 'component-name' => $formName, 'component-path' => "/admin-panel/{$this->tableName}/form/:id"]);

        $modulesString = "[";

        foreach ($modules as $module) {
            $componentName = str_replace('Edit', '', $module['route-name']);
            $modulesString .= "{'component-path': '{$module['component-path']}', 'component-name': {$componentName}, 'route-name': '{$module['route-name']}'},";
        }
        $modulesString .= "]";

        $newExportDefault = "export default " . $modulesString;

        $newCmsRoutesContent = implode(";\n", $imports)  . ";\n\n\n" . $newExportDefault . ";";



        $newCmsRoutes = fopen($cmsRoutesPath, "w");
        fwrite($newCmsRoutes, $newCmsRoutesContent);
        fclose($newCmsRoutes);
    }
}
