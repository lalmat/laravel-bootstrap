<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DbDump extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:dump';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dump database';

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
     * @return mixed
     */
    public function handle()
    {
        $this->logStart();
        try {
            $date = date('YmdHis').'.sql';
            $user = env('DB_USERNAME');
            $pass = env('DB_PASSWORD');
            $base = env('DB_DATABASE');
            $path = app_path()."/../database";

            // Suppression des dumps de j-3
            $this->logInfo("Deleting of database dump... Please wait...");
            $dateDel = date('Ymd', mktime(0,0,0,date('m'), date('d')-3, date('Y')));
            shell_exec("rm -f {$path}/{$base}_{$dateDel}*.sql.gz");

            $this->logInfo("Dumping {$base} into {$base}.sql... Please wait...");
            $rsDump = shell_exec("mysqldump -u {$user} -p{$pass} {$base} > {$path}/{$base}_{$date}.sql 2> /dev/null");
            if ($rsDump !== FALSE) {
                $rsGzip = shell_exec("cd {$path} && gzip {$base}_{$date}.sql");
                if ($rsGzip !== FALSE) {
                    $this->logInfo("Dump and Zip succeed");
                    $this->setFileCount(1);
                }
                else {
                    throw new \Exception("GZIP compression failed.");
                }
            }
            else {
                throw new \Exception("MySQL dump failed.");
            }

        }
        catch(\Exception $e) {
            $this->logException($e);
        }
        $this->logSave();
    }
}
