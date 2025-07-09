<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\PasswordReset;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'reference','lastname','date_naissance', 'type_user','contact','contact_fixe','photo','num_cni','adresse','sexe','ville','country_id','code_verification','photo_cni','num_agrement','localisation', 'registre_commerce','etat','status','description','agence_id','deleted','locataire_id','role','remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $attributes = ['type_user' => 0,'role' => 0];

    public function getTypeUser($attribute)
    {
        return $this->typeUser()[$attribute];
    }

    public function getRoleUser($attribute)
    {
        return $this->role()[$attribute];
    }

    public function typeUser(){
        return [
            0 => 'Proprietaire',
            1 => 'Locataire',
            2 => 'Agent',
        ];
    }

    public function role(){
        return [
            1 => 'Agent Simple',
            2 => 'Admin',
            3 => 'Super Admin',
        ];
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }

    public function scopeProprietaires($query)
    {
        return $query->where(['etat' => 1,'type_user' => 0,'agence_id'=>auth()->user()->agence->id]);
    }
    public function scopeLocataires($query)
    {
        return $query->where(['etat' => 1,'type_user' => 1,'agence_id'=>auth()->user()->agence->id]);
    }
    public function scopeAgents($query)
    {
        return $query->where(['etat' => 1,'type_user' => 2,'agence_id'=>auth()->user()->agence->id]);
    }
    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }
    public function appartements()
    {
        return $this->hasMany(Appartement::class,'proprietaire_id')->where(['etat' => 1,'archived'=>0,"deleted"=>0,'agence_id'=>auth()->user()->agence->id]);
    }
    public function appartementsAgence()
    {
        return $this->hasMany(Appartement::class,'agence_id')->where(['agence_id'=>auth()->user()->agence->id]);
    }

    public function factures()
    {
        return $this->hasMany(Facture::class,'locataire_id')->where(['etat' => 1,"deleted"=>0,'agence_id'=>auth()->user()->agence->id]);
    }
    public function incidents()
    {
        return $this->hasMany(Incident::class,'locataire_id')->where(['etat' => 1,'archived'=>0,"deleted"=>0,'agence_id'=>auth()->user()->agence->id]);
    }
    public function locations()
    {
        return $this->hasMany(Location::class,'locataire_id')->where(['etat' => 1,'archived'=>0,"deleted"=>0,'agence_id'=>auth()->user()->agence->id]);
    }
    public function mode_paiement()
    {
        return $this->hasMany(MoyenPaiement::class);
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    public function paiementLoyer()
    {
        return $this->hasMany(PaiementLoyer::class);
    }
    // public function factures()
    // {
    //     return $this->hasMany(Facture::class);
    // }
    public function prelevements()
    {
        return $this->hasMany(Prelevement::class);
    }
    public function reparation()
    {
        return $this->hasMany(Reparation::class);
    }
    public function resiliation()
    {
        return $this->hasOne(Resiliation::class);
    }
    public function suggestions()
    {
        return $this->hasMany(Suggestion::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function paiement_loyers(){
        return $this->hasMany(PaiementLoyer::class,'locataire_id')->where(['deleted'=>0,"etat"=>1,'agence_id'=>auth()->user()->agence->id]);
    }

    public function fichiers_contrats()
    {
        return $this->belongsTo(FichierContrat::class,'locataire_id')->where(['deleted'=>0,"archived"=>0,'agence_id'=>auth()->user()->agence->id]);
    }
  
     public function modepaiements()
    {
        return $this->hasMany(MoyenPaiement::class);
    }
    // public function incidents()
    // {
    //     return $this->hasMany(Incident::class,'locataire_id');
    // }

    public function reparations()
    {
        return $this->hasMany(Reparation::class,'locataire_id');
    }
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}
