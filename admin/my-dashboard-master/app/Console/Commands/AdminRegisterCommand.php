<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Exception;
use Illuminate\Console\Command;

class AdminRegisterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:register {name : Name} {email : Email address} {pwd : Password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to register system administrator';

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
        try
        {
            if(Admin::all()->count() > 0)
                return $this->warn('Sorry, it is not possible to register more than one administrator!');

            $admin = Admin::create([
                'name'      => $this->argument('name'),
                'email'     => $this->argument('email'),
                'password'  => bcrypt($this->argument('pwd')),
            ], true);

            if(is_null($admin))
                return $this->error('Sorry, unable to register admin!');

            return $this->info('Admin successfully registered!');
        }
        catch(Exception $e)
        {
            return $this->error('Sorry, unable to register admin!');
        }
    }
}
