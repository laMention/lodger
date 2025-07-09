<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appartement extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference','code_appart','user_id','proprietaire_id','categorie','libelle','niveau','adresse','description','image','etat','agence_id','montant_loyer','statut','type_commerce','deleted','nb_chambre','devise','archived','num_appart','meuble','type_immobilier','annee_construction','destination_local','surface_habitable','nb_piece_principale'
    ];
    
    protected $attributes = ['statut' => 0, 'categorie' => 0,'meuble'=>0];

    public function getStatut($attribute)
    {
        return $this->statut()[$attribute];
    }

    public function statut(){
        return [
            0 => 'Disponible',
            1 => 'Occupé',
        ];
    }
    public function getCategorie($attribute)
    {
        return $this->categorie()[$attribute];
    }

    public function categorie(){
        return [
            1 => 'Appartement',
            2 => 'Villa',
            3 => 'Commerce',
        ];
    }

    public function getMeuble($attribute)
    {
        return $this->meuble()[$attribute];
    }

    public function meuble(){
        return [
            0 => 'Vide',
            1 => 'Meublé',
        ];
    }

    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }
    public function proprietaire()
    {
        return $this->belongsTo(User::class,'proprietaire_id')->where(['etat' => 1,"deleted"=>0]);
    }
    public function locataire()
    {
        return $this->belongsTo(User::class,'locataire_id')->where(['etat' => 1,"deleted"=>0 ]);
    }
    public function agent()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function loyer()
    {
        return $this->belongsTo(Loyer::class);
    }
    public function caution()
    {
        return $this->hasOne(Caution::class);
    }
    public function avance()
    {
        return $this->hasOne(AvanceLoyer::class);
    }
    public function commission()
    {
        return $this->hasOne(CommissionAgence::class);
    }
    public function location()
    {
        return $this->hasOne(Location::class);
    }

    public function incidents()
    {
        return $this->hasMany(Incident::class);
    }

    public function equipements()
    {
        return $this->belongsToMany(Equipement::class);
    }

    public function equipementsbiens()
    {
        return $this->hasMany(AppartementEquipement::class);
    }

    public function points_forts()
    {
        return $this->belongsToMany(PointFort::class);
    }

    public function points_forts_biens()
    {
        return $this->hasMany(AppartementPointFort::class);
    }

    public function comodites()
    {
        return $this->belongsToMany(Comodite::class);
    }

    public function comodites_biens()
    {
        return $this->hasMany(AppartementComodite::class);
    }
}
