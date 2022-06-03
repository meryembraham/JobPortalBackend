<?php

namespace Database\Seeders;

use App\Models\Entreprise;
use Illuminate\Database\Seeder;

class EntrepriseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entreprise = new Entreprise([
            'user_id' => 2,
            'region_id'=>7,
            'nom_entreprise' =>'TUNTEX  ',
            'description' =>'Chargé de l’accueil, du planning, des rendez-vous et de l’administratif, l’assistant fait l’interface entre les membres d’une entreprise et ses relations avec l’extérieur, clients, fournisseurs et prestataires. Une fonction indispensable, …',
            'categorie' =>'Société privée étrangère',
            'logo' =>'logo',
            'cover_img'=>'cover_img',
            'site'=>'site',
            'adresse' => 'CHARGUIA 1 , Ariana Ville, Ariana, 2035 Tunisie',
            'tel'=> 32532515,
            'slogan' => 'slogan',
            'secteur_id'=>1,

        ]);
        $entreprise->save();
        $entreprise = new Entreprise([
            'user_id' => 3,
            'region_id'=>4,
            'nom_entreprise' =>'PARTNER RECRUITMENT',
            'description' =>'Partner Recruitment spécialisé dans la recherche d’adéquation Entreprise/Candidat, vous propose une large palette de solutions pour trouver et sélectionner les meilleures compétences.
            Partner Recruitment réalise en totale collaboration avec vous une étude préliminaire des fonctions exercées du poste à pourvoir sur la base de son outil spécifique d’audit de recrutement. On rédige ensuite sous forme de synthèse une définition de fonction reformulant le contexte du recrutement, le contenu du poste ainsi que les compétences et le profil du collaborateur recherché',
            'categorie' =>'Société privée locale',
            'logo' =>'logo',
            'cover_img'=>'cover_img',
            'site'=>'site',
            'adresse' => '29, Rue Abou TAMAM, Cite El Khadra, Tunis, 1082 Tunisie',
            'tel'=> 32532515,
            'slogan' => 'slogan',
            'secteur_id'=>2,
            


        ]);
        $entreprise->save();
        $entreprise = new Entreprise([
            'user_id' => 4,
            'region_id'=>19,
            'nom_entreprise' =>'AT SERVICES',
            'description' =>'PhoneAct Call Center est certifié ISO 9001 2015 à travers son site de Tunis qui accueille plus de 400 collaborateurs et possède une capacité de 500 positions de centre d’appels. PhoneAct Call Center est le leader des call centers indépendants en Tunisie. PhoneAct Call Center est aussi présente en France à travers sa filiale Axiome Media...',
            'categorie' =>'Société privée étrangère',
            'logo' =>'logo',
            'cover_img'=>'cover_img',
            'site'=>'site',
            'adresse' => '1, Rue Kabbadou, La Marsa, La Marsa, Tunis, 2070 Tunisie',
            'tel'=> 32532515,
            'slogan' => 'slogan',
            'secteur_id'=>3,
            


        ]);
        $entreprise->save();
        $entreprise = new Entreprise([
            'user_id' => 5,
            'region_id'=>18,
            'nom_entreprise' =>'PROCHIDIA',
            'description' =>'out en développant le conseil et le service auprès de ses clients, PROCHIDIA, filiale de Kilani Groupe, est une société importatrice et distributrice de réactifs et équipements de laboratoire, d’accessoires médicaux et chirurgicaux, ainsi que de produits parapharmaceutiques.',
            'categorie' =>'Société privée locale',
            'logo' =>'logo',
            'cover_img'=>'cover_img',
            'site'=>'site',
            'adresse' => '25, Rue 8603 - Z.I. La Charguia 1, Charguia 1, Ariana, 2035 Tunisie',
            'tel'=> 32532515,
            'slogan' => 'slogan',
            'secteur_id'=>3,
            


        ]);
        $entreprise->save();
        $entreprise = new Entreprise([
            'user_id' => 6,
            'region_id'=>17,
            'nom_entreprise' =>'PHONEACT',
            'description' =>'description',
            'categorie' =>'Société privée locale',
            'logo' =>'logo',
            'cover_img'=>'cover_img',
            'site'=>'http://www.phoneact.com',
            'adresse' => '6 Rue des entrepreneurs, Charguia 2, La Soukra, Ariana, 2035 Tunisie',
            'tel'=> 32532515,
            'slogan' => 'slogan',
            'secteur_id'=>3,
            


        ]);
        $entreprise->save();//
    }
}
