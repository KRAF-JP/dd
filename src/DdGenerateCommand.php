<?php

declare(strict_types=1);

namespace Krafjp\Dd;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use InvalidArgumentException;
use League\HTMLToMarkdown\HtmlConverter;
use League\HTMLToMarkdown\Converter\TableConverter;

class DdGenerateCommand extends Command
{
    const CODE_SUCCESS = 0;
    const CODE_ERROR = 1;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:dd-gen {conn? : db connection null by default} {--m | --output-md}';

    /**
     * @var HtmlConverter
     */
    private HtmlConverter $converter;


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Database Definition Document Commands';

    function __construct(HtmlConverter $converter, TableConverter $tableConverter)
    {
        parent::__construct();
        $this->converter = $converter;
        $this->converter->getConfig()->setOption('strip_tags', true);
        $this->converter->getConfig()->setOption('header_style', 'atx');
        $this->converter->getConfig()->setOption('hard_break', false);
        $this->converter->getEnvironment()->addConverter($tableConverter);
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $conn = $this->argument('conn');

        try {
            $this->generateDocument($conn);
        } catch (Exception $exception) {
            $this->error($exception->getMessage());

            return self::CODE_ERROR;
        }

        $this->info('Database Definition Document generated successfully.');

        return self::CODE_SUCCESS;
    }


    /**
     * @throws \Doctrine\DBAL\Exception | InvalidArgumentException | QueryException
     */
    protected function generateDocument(?string $conn): void
    {
        $schema = DB::connection($conn)->getDoctrineSchemaManager();
        $databaseName = '';
        foreach ($schema->listDatabases() as $database) {
            if ($database !== 'information_schema') {
                $databaseName = $database;
                break;
            }
        }
        $tables = [];
        foreach ($schema->listTables() as $table) {
            $foreignKeys = $table->getForeignKeys();
            $localColumns = [];
            $fKeys = [];
            if ($foreignKeys) {
                foreach ($foreignKeys as $key => $fk) {
                    $fKeys[] = [
                        'keyName' => $key,
                        'localColumn' => $fk->getLocalColumns(),
                        'foreignTableName' => $fk->getForeignTableName()
                    ];
                    $localColumns = [...$localColumns, $fk->getLocalColumns()[0]];
                }
            }

            $tables[] = [
                'name' => $table->getName(),
                'comment' => $table->getComment(),
                'columns' => $table->getColumns(),
                'options' => $table->getOptions(),
                'primaryKeys' => $table->hasPrimaryKey() ? $table->getPrimaryKey()->getColumns() : [],
                'foreignKeys' => $fKeys,
                'localColumns' => $localColumns,
                'indexes' => $table->getIndexes(),
            ];
        }

        $html = view('dd.html.contents', [
            'title' => 'テーブル定義書',
            'databaseName' => $databaseName,
            'tables' => $tables,
            'createdAt' => Carbon::now('Asia/Tokyo')
        ])->render();

        $this->option('output-md') ?
            file_put_contents('database-definition.md', $this->converter->convert($html))
            : file_put_contents('database-definition.html', $html);
    }
}
