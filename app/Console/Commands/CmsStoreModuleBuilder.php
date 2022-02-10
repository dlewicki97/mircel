<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CmsStoreModuleBuilder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $variable = "";
    protected $table_name = "";
    protected $signature = 'store {table_name} {--variable=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create store module';

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
        $this->variable = $this->option('variable') ?? Str::camel($this->argument('table_name'));
        $variableFirstUpper = ucfirst($this->variable);
        $this->table_name = $this->argument('table_name');

        $modulesFolder = __DIR__ . "/../../../resources/js/store/modules";
        $newModuleFolder = $modulesFolder . "/{$this->variable}";
        if (is_dir($newModuleFolder)) return;
        mkdir($newModuleFolder);
        $exampleModulePath = $modulesFolder . "/example/exampleModule.js";
        $exampleModuleContent = file_get_contents($exampleModulePath);
        $newModuleContent = str_replace(['example', 'table_name'], [$this->variable, $this->table_name], $exampleModuleContent);


        $newModuleFile = fopen("$newModuleFolder/{$this->variable}Module.js", "w");
        fwrite($newModuleFile, $newModuleContent);
        fclose($newModuleFile);

        $storePath = __DIR__ . "/../../../resources/js/store/store.js";

        $storeFile = file_get_contents($storePath);

        $lines = explode(';', $storeFile);
        $imports = array_filter($lines, function ($item) {
            return strpos($item, 'import') !== FALSE;
        });
        $imports = array_map(function ($import) {
            return preg_replace('/\n/', '', $import);
        }, $imports);


        $vueUses = array_filter($lines, function ($item) {
            return strpos($item, 'Vue.use') !== FALSE;
        });
        $vueUses = array_map(function ($use) {
            return preg_replace('/\n/', '', $use);
        }, $vueUses);

        $exportDefault = array_values(array_filter($lines, function ($item) {
            return strpos($item, 'export default') !== FALSE;
        }))[0];

        $exportDefault = preg_replace('/\s+/', '', $exportDefault);


        preg_match('/modules:{(.*?)}/', $exportDefault, $match);

        $modules = explode(',', str_replace("}", "", $match[1]));

        if (empty(array_filter($imports, function ($import) {
            return strpos($import, $this->variable) !== FALSE;
        }))) $imports[] = "import $variableFirstUpper from \"@/store/modules/{$this->variable}/{$this->variable}Module.js\"";


        if (empty(array_filter($modules, function ($module) use ($variableFirstUpper) {
            return $module == $variableFirstUpper;
        }))) $modules[] = "$variableFirstUpper";

        $newExportDefault = "export default new Vuex.Store({
            modules: {
                " . implode(",\n\t\t\t\t", $modules) . "
            }
        });";

        $newStoreContent = implode(";\n", $imports) . ";\n\n\n" . implode(";\n", $vueUses) . ";\n\n\n" . $newExportDefault;

        $newStoreFile = fopen($storePath, "w");
        fwrite($newStoreFile, $newStoreContent);
        fclose($newStoreFile);
    }
}
