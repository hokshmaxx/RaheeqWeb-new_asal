<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin;
use DB;
use SebastianBergmann\Environment\Console;


class TestCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
               
        $fields = [
            'merchant_id' => env('MERCHAND_ID'),
            'username' => env('UPAY_USERNAME'),
            'password'=> env('UPAY_PASSWORD')
        ];
    
        $fields_string = http_build_query($fields);  
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL,"https://api.upayments.com/api/merchant/token");
        curl_setopt($ch, CURLOPT_POST, 1);  
        curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
        // receive server response ...  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        $server_output = curl_exec($ch);
        curl_close($ch);
        
        $server_output = json_decode($server_output,true);  
        
        $data =[
            'api_auth_token' =>$server_output['api_auth_token'],
        ];
  
        $query = Admin::where('id', 1)->first();
        $query->update( $data);  
        return 1;
        return $server_output = json_decode($server_output,true);  

    }
}
