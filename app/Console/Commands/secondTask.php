<?php

namespace App\Console\Commands;
use DB;
use Illuminate\Console\Command;

class secondTask extends Command
{    public $foodList=["steak","grnd_beef","sausage","fry_chick","tuna"];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

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
     * @return mixed
     */
    public function handle()
    {   $finallistString="";
      
        $stateList =  DB::table('ap_states')->pluck('state');
       
            
            foreach($stateList as $state)
                {   $finallistString=$finallistString.$state.":";
                    foreach($this->foodList as $food){
                        $foodAverage =  DB::select(DB::raw("select AVG(".$food.") from ap_copi WHERE state = '".$state."'"));
                       
                        $finallistString=$finallistString.$food."(".$foodAverage{0}->{"AVG(".$food.")"}.") ";
                   
                        
                    }   
                    $finallistString=$finallistString."\n";
                    
                    
            
           }
          
            var_dump($finallistString);

        
      
    }
}
