<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {   
        if ($this->role=='entreprise'){
        return [
                'nom'=>$this->nom,
                'prenom'=>$this->prenom,
                'email'=>$this->email,
                'nom'=>$this->nom,
                'entreprise_info'=> new EntrepriseResource($this->entreprise_info)
        ];
        }elseif($this->role=='condidat'){
        return [
                'nom'=>$this->nom,
                'prenom'=>$this->prenom,
                'email'=>$this->email,
                'nom'=>$this->nom,
                'condidat_info'=> new CondidatResource($this->condidat_info)

        ]; 
        }
    }
}
