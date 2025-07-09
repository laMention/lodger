<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Traits\Generator;
use App\Models\Facture;
use App\Models\User;
use App\Models\Location;
use Carbon\Carbon;
use Auth;
use DB;

class GenerateFacture extends Command
{
    use Generator;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GenerateFacture:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Invoice For location payments';


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
        $prefix = 'FAC-';

        // $this->info('Generate Facture: cron run successfully');
        $arr_location = Location::where(['agence_id'=>auth()->user()->agence->id,'etat' => 1,'deleted'=>0,'archived'=>0])->get();

        if (count($arr_location) > 0) {
            foreach ($arr_location as $key => $value) {
                // verifier si une facture existe pour une location donnée
                $factures = Facture::where(['etat' => 1,'location_id'=>$value->id])->get();
               

                if (count($factures) <= 0) {
                    // Si aucune facture n'existe dans la base de données
                    $facture = Facture::create([
                        'periode' => date('F Y',strtotime($value->date_location)) .'-'.date('F Y',strtotime($value->date_location.'+ 30 days')),
                        'user_id' => $value->user_id,
                        'location_id' => $value->id,
                        'fichier' => NULL,
                        'etat' => 1,
                        'status' => 0,
                        'agence_id' => $value->agence_id,
                        'locataire_id' => $value->locataire_id,
                        'date_echeance' => date('Y-m-d H:i:s',strtotime($value->date_location.'+ 30 days')),
                        'next_date_echeance' => NULL
                    ]);
                    if ($facture) {
                        Facture::where(['id'=>$facture->id])->update([
                        'reference' =>$prefix. $this->reference(),
                        'next_date_echeance' => date('Y-m-d H:i:s',strtotime($facture->date_echeance.'+ 30 days'))]);
                    }
                }else{
                    // Si une facture existe
                    $facture = Facture::latest('id')->first();

                    $next_facture = Facture::create([
                        // 'reference' => $this->reference(),
                        
                        'periode' =>date('F Y',strtotime($facture->next_date_echeance)).'-'. date('F Y',strtotime($facture->next_date_echeance.'+ 30 days')),
                        'user_id' =>  $value->user_id,
                        'location_id' => $value->id,
                        'fichier' => NULL,
                        'etat' => 1,
                        'status' => 0,
                        'agence_id' => $value->agence_id,
                        'locataire_id' => $value->locataire_id,
                        'date_echeance' => date('Y-m-d H:i:s',strtotime($facture->next_date_echeance.'+ 30 days')),
                        'next_date_echeance' => NULL
                    ]);

                    if ($next_facture) {
                        Facture::where(['id'=>$next_facture->id])->update([
                            'reference' =>$prefix. $this->reference(),

                            'next_date_echeance' => date('Y-m-d H:i:s',strtotime($next_facture->date_echeance.'+ 30 days'))]);
                    }
                }
            }
        }
        
    }
}
