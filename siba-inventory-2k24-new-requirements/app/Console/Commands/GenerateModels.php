<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GenerateModels extends Command
{
    protected $signature = 'generate:models';

    protected $description = 'Generate models for all tables in the database';

    public function handle()
    {
        $tables = DB::connection()->getDoctrineSchemaManager()->listTableNames();

        foreach ($tables as $table) {
            $model = Str::studly(Str::singular($table));

            // Generate the model file
            $this->call('make:model', ['name' => $model]);

            $this->SetFillablePlaceholder($model);

            // Add fillable fields to the model
            $this->addFillableToModel($model, $table);
        }

        $this->info('Models generated successfully!');
    }

    protected function SetFillablePlaceholder($model)
    {
        usleep(50000); // Add a delay of 50 milliseconds to allow file creation

        $file = app_path("Models\\" . $model . ".php"); // Replace with the path to your PHP file
        $customText = "\t// FILLABLE_FIELDS";

        $fileLines = file($file);

        foreach ($fileLines as $index => $line) {
            if (strpos($line, 'use HasFactory;') !== false) {
                $insertIndex = $index + 1; // Insert after the specific line
                array_splice($fileLines, $insertIndex, 0, $customText);
                break;
            }
        }

        $fileContent = implode('', $fileLines);
        file_put_contents($file, $fileContent);
    }

    protected function addFillableToModel($model, $table)
    {
        usleep(50000); // Add a delay of 50 milliseconds to allow file creation

        $modelPath = app_path("Models\\" . $model . ".php");
        $fillableFields = $this->getFillableFields($table);

        // Check if the model file exists
        if (!file_exists($modelPath)) {
            $this->error("Model file does not exist at path {$modelPath}.");
            return;
        }

        $content = file_get_contents($modelPath);

        $fillable = "protected \$fillable = [\n";
        foreach ($fillableFields as $field) {
            $fillable .= "        '{$field}',\n";
        }
        $fillable .= "    ];\n";

        // Find the placeholder text and replace it with the fillable fields
    $placeholder = '// FILLABLE_FIELDS';
    if (strpos($content, $placeholder) !== false) {
        $content = str_replace($placeholder, $fillable, $content);
    } else {
        $content = str_replace('protected $fillable = [];', $fillable, $content);
    }

    file_put_contents($modelPath, $content);
    }

    protected function getFillableFields($table)
    {
        $columns = DB::connection()->getDoctrineSchemaManager()->listTableColumns($table);

        $fillableFields = [];
        foreach ($columns as $column) {
            if (!$column->getAutoincrement()) {
                $fillableFields[] = $column->getName();
            }
        }

        return $fillableFields;
    }
}


?>
