<?php

declare(strict_types=1);

namespace Krafjp\Dd;

use Illuminate\Console\Command;
use InvalidArgumentException;

class DdSetupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:dd
                    
                    {--force : Overwrite existing views by default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold Database Definition Generator init.';

    /**
     * The views that need to be exported.
     *
     * @var array
     */
    protected array $views = [
        'contents.stub' => 'dd/html/contents.blade.php',
        'layout.stub' => 'dd/html/layout.blade.php',
        'table-columns.stub' => 'dd/html/table-columns.blade.php',
        'table-detail.stub' => 'dd/html/table-detail.blade.php',
        'table-foreign-keys.stub' => 'dd/html/table-foreign-keys.blade.php',
        'table-indexes.stub' => 'dd/html/table-indexes.blade.php',
        'table-information.stub' => 'dd/html/table-information.blade.php',
        'table-list.stub' => 'dd/html/table-list.blade.php',
    ];

    /**
     * Execute the console command.
     *
     * @return void
     *
     * @throws InvalidArgumentException
     */
    public function handle(): void
    {
        $this->ensureDirectoriesExist();
        $this->exportViews();

        $this->info('Database Definition scaffolding generated successfully.');
    }

    /**
     * Create the directories for the files.
     *
     * @return void
     */
    protected function ensureDirectoriesExist()
    {
        if (!is_dir($directory = $this->getViewPath('dd/html'))) {
            mkdir($directory, 0755, true);
        }
    }

    /**
     * Export the authentication views.
     *
     * @return void
     */
    protected function exportViews(): void
    {
        foreach ($this->views as $key => $value) {
            if (file_exists($view = $this->getViewPath($value)) && !$this->option('force')) {
                if (!$this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
                    continue;
                }
            }

            copy(
                __DIR__ . '/templates-stubs/' . $key,
                $view
            );
        }
    }

    /**
     * Get full view path relative to the application's configured view path.
     *
     * @param string $path
     * @return string
     */
    protected function getViewPath(string $path): string
    {
        return implode(DIRECTORY_SEPARATOR, [
            config('view.paths')[0] ?? resource_path('views'),
            $path,
        ]);
    }
}