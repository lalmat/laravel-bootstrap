<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Person;

class updatePeople extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:people {jsonUrl}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load people and update them';

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
        $url = $this->argument('jsonUrl');
        $this->importPerson($url);
    }


    public function importPerson($url) {
        $data = $this->url2data($url);
        $nbItems = count($data);
        $bar = $this->output->createProgressBar($nbItems);
        $bar->start();

        foreach($data as $d) {
            $p = Person::find($d->id);
            if (empty($p)) {
                $p = new Person();
                $p->id = $d->id;
            }
            $p->firstname    = $d->first_name;
            $p->lastname     = $d->last_name;
            $p->title        = $d->title;
            $p->login        = $d->login;
            $p->login_email  = $d->login_email;
            $p->email        = $d->user_email;
            $p->company      = $d->company;
            $p->department   = $d->department;
            $p->service      = $d->service;
            $p->basement     = $d->basement;
            $p->country      = $d->country;
            $p->tel_external = $d->tel_external;
            $p->tel_internal = $d->tel_internal;
            $p->ldap         = $d->ldap;
            $p->ldap_stamp   = $d->ldap_stamp;
            $p->manager_ldap = $d->manager_ldap;
            $p->manager_id   = $d->manager_id;

            $p->save();
            $bar->advance();
        }
        $bar->finish();
        $this->info(PHP_EOL."{$nbItems} personne(s) importée(s).");
    }

    public function url2data($url) {
        $this->line("Fetching data from {$url}");
        $json = file_get_contents($url);
        return json_decode($json);
    }
}
