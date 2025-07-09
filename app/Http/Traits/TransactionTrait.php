<?php
  namespace App\Http\Traits;

    

  use App\Models\Transaction;
  use Illuminate\Support\Facades\Request;
  use Illuminate\Support\Facades\Validator;
  use DB;


  /**
   * 
   */
  trait TransactionTrait
  {
    
      public function saveTransaction($titre,$date_transaction,$montant,$devise,$moyen_paiement,$etat,$agence_id)
      {
         return Transaction::create([
          'titre' => $titre,
          'date_transaction' => $date_transaction,
          'montant' => $montant,
          'devise' => $devise,
          'moyen_paiement' => $moyen_paiement,
          'etat' => $etat,
          'deleted' => false,
          'agence_id' => $agence_id
         ]);
      }

  }