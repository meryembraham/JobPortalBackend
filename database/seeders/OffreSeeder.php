<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Offre;
class OffreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $offre = new Offre([
            'entreprise_id' =>1,
            'secteur_id' =>4,
            'region_id'=>1,
            'titre'=>'titre',
            'type_contrat'=>'sivp',
            'date_debut'=>'22-22-22',
            'diplome'=>'diplome',
            'exigences'=>'exigences',
            'avantages'=>'avantages',
            'rythme'=>'rythme',
            'salaire'=>'salaire',
            'outils'=>'outils',
            'description'=>'desciption',
            'competences'=>'conpetences',
            'etat_offre'=>'active',
            'condidat_id'=>null,
            'experience'=>'1an'


        ]);
        $offre->save();
        $offre = new Offre([
            'entreprise_id' =>1,
            'secteur_id' =>9,
            'region_id'=>17,
            'titre'=>'Technicien Réseaux et Système',
            'type_contrat'=>'cdi',
            'date_debut'=>'29-05-2022',
            'diplome'=>'Bac + 3',
            'exigences'=>'Vous et vos atouts :

            Diplômé d’un bac +2, équivalent BTS informatique système et réseau d’entreprises. Vous justifiez d’une expérience réussie de 2 ans dans un poste similaire.
            
            Vous avez une parfaite maîtrise de la langue française avec un niveau B2 minimum, à l’oral et à l’écrit.',
            'avantages'=>'avantages',
            'rythme'=>'Plein temps',
            'salaire'=>'1000 - 1200 DT / Mois',
            'outils'=>'outils',
            'description'=>'Agence Télécom Services, Filiale du Premier distributeur indépendant de SFR Business Basé en France, cherche à recruter un(e)Technicien(ne)  Réseaux et Système pour son site basé à Tunis.

            Vos missions :
            
            -  Analyser et résoudre les incidents déclarés
            
            - Gérer la mise en service des routeurs et switch
            
            - Prendre en charge des demandes et accompagner les techniciens terrain
            
            - Administrer le système',
            'competences'=>"curiosité,rigueur ,sens de l'organisation,élocution",
            'etat_offre'=>'active',
            'condidat_id'=>null,
            'experience'=>'Entre 1 et 2 ans'

        ]);
        $offre->save();
        $offre = new Offre([
            'entreprise_id' =>2,
            'secteur_id' =>13,
            'region_id'=>6,
            'titre'=>'Consultant Support Retail',
            'type_contrat'=>'sivp',
            'date_debut'=>'datedebut',
            'diplome'=>'Entre 1 et 2 ans',
            'exigences'=>'Licence en informatique

            ·   Bon niveau anglais & français (écrit et oral)
            
            ·   Compétences dans l’utilisation d’un ERP et/ou un CRM.
            
            ·   Compétences dans l’analyse fonctionnelle dans un contexte de projet informatique.
            
            ·   Maîtrise avancée du langage SQL et des bases de données SQL Server.
            
            ·   Bonne communication orale et écrite, esprit d’équipe.',
            'avantages'=>': Assurance groupe, tickets restos',
            'rythme'=>'Plein temps',
            'salaire'=>'salaire',
            'outils'=>'outils',
            'description'=>'  Suivi du Backlog de tickets, Prise en charge des tickets,Appel ou réponse à l’appel du client,Analyse des tickets et rédaction d’analyse
,Tests en interne, et/ou sur environnement client
,Validation de la solution ou du ticket avec le client
,Résolution des tickets ou escalade',
            'competences'=>'Bonne communication orale et écrite,Orientation client,Conviction et Influence',
            'etat_offre'=>'active',
            'condidat_id'=>null,
            'experience'=>'1an'


        ]);
        $offre->save();
        $offre = new Offre([
            'entreprise_id' =>2,
            'secteur_id' =>22,
            'region_id'=>16,
            'titre'=>'commercial B2B',
            'type_contrat'=>'CDI',
            'date_debut'=>'datedebut',
            'diplome'=>'Bac + 1',
            'exigences'=>'exigences',
            'avantages'=>'avantages',
            'rythme'=>'rythme',
            'salaire'=>'900 - 1200 DT / Mois',
            'outils'=>'outils',
            'description'=>"Vous maîtrisez parfaitement le français , avez vous une bonne élocution et la capacité à comprendre et assimiler facilement les besoins des client français , pour répondre à leurs besoins .

            Nous sommes à la recherche des commerciaux seniors /juniors (selon expérience ) en télévente B2B disposant d'une expérience réussie d'un an à deux ans dans une activité de vente ",
            'competences'=>'Ambitieux et motivé par les challenges ,Rigueur , réactivité et persévérance',
            'etat_offre'=>'active',
            'condidat_id'=>null,
            'experience'=>"Moins d'un an"


        ]);
        $offre->save();
        $offre = new Offre([
            'entreprise_id' =>3,
            'secteur_id' =>10,
            'region_id'=>14,
            'titre'=>"Manager / Superviseur d'Equipe",
            'type_contrat'=>'sivp',
            'date_debut'=>'datedebut',
            'diplome'=>'Bac + 3',
            'exigences'=>'Parfaite maîtrise de la langue française,Bonne connaissance du marché du transfert d’entreprises en IDF,',
            'avantages'=>'avantages',
            'rythme'=>'Plein temps',
            'salaire'=>'2000 - 2200 DT / Mois',
            'outils'=>'outils',
            'description'=>' Animation et encadrement de son équipe (présentation de l’entreprise, organisation, formation, accompagnement, conseil, suivi, contrôle),
            Prospection de nouveaux clients (entreprises publiques et privées, mutation de leurs Agents) :',
            'competences'=>'conpetences',
            'etat_offre'=>'active',
            'condidat_id'=>null,
            'experience'=>'Entre 2 et 5 ans'


        ]);
        $offre->save();
        $offre = new Offre([
            'entreprise_id' =>3,
            'secteur_id' =>7,
            'region_id'=>2,
            'titre'=>'Chargé comptabilité française (H/F)',
            'type_contrat'=>'sivp',
            'date_debut'=>'datedebut',
            'diplome'=>'Bac + 5',
            'exigences'=>"Centraliser et contrôler l’exactitude des pièces comptables (achats, banques, …)
            Etablir et contrôler l'exactitude des écritures comptables (achats, ventes, tenue des comptes),",
            'avantages'=>'avantages',
            'rythme'=>'Plein temps',
            'salaire'=>'1300 - 1500 DT / Mois',
            'outils'=>'outils',
            'description'=>'desciption',
            'competences'=>'Être polyvalent(e) et autonome.',
            'etat_offre'=>'active',
            'condidat_id'=>null,
            'experience'=>'Entre 2 et 5 ans'


        ]);
        $offre->save();
        $offre = new Offre([
            'entreprise_id' =>4,
            'secteur_id' =>6,
            'region_id'=>8,
            'titre'=>'Concepteur Rédacteur Francophone (H/F)',
            'type_contrat'=>'CDI',
            'date_debut'=>'datedebut',
            'diplome'=>'diplome',
            'exigences'=>'Une formation supérieure est souhaitée (littérature, communication,
            journalisme, marketing, économie).',
            'avantages'=>'avantages',
            'rythme'=>'Plein tempse',
            'salaire'=>'900 - 1000 DT / Mois',
            'outils'=>'outils',
            'description'=>'Conception et rédaction de contenus, textes et argumentaires commerciaux
            percutants et innovants dans le respect des chartes éditoriale et graphique
            établies et en accord avec les objectifs business.',
            'competences'=>'Solides capacités d’innovation et de création.',
            'etat_offre'=>'active',
            'condidat_id'=>null,
            'experience'=>'Entre 2 et 5 ans'


        ]);
        $offre->save();
        $offre = new Offre([
            'entreprise_id' =>4,
            'secteur_id' =>4,
            'region_id'=>10,
            'titre'=>"Team Assistant - chargé de l'accueil",
            'type_contrat'=>'sivp',
            'date_debut'=>'datedebut',
            'diplome'=>'Bac + 3',
            'exigences'=>'exigences',
            'avantages'=>'avantages',
            'rythme'=>'Plein temps',
            'salaire'=>'800 - DT / Mois',
            'outils'=>'outils',
            'description'=>'Chargé de l’accueil, du planning, des rendez-vous et de l’administratif, l’assistant fait l’interface entre les membres d’une entreprise et ses relations avec l’extérieur, clients, fournisseurs et prestataires. Une fonction indispensable, aux missions plus élargies que du simple travail de secrétariat.',
            'competences'=>'conpetences',
            'etat_offre'=>'active',
            'condidat_id'=>null,
            'experience'=>'Aucune expérience'


        ]);
        

        $offre->save();
        $offre = new Offre([
            'entreprise_id' =>5,
            'secteur_id' =>3,
            'region_id'=>1,
            'titre'=>'Ingénieur Full-Stack H/F',
            'type_contrat'=>'sivp',
            'date_debut'=>'datedebut',
            'diplome'=>'Bac + 5',
            'exigences'=>'exigences',
            'avantages'=>'avantages',
            'rythme'=>'Plein temps',
            'salaire'=>'salaire',
            'outils'=>'JS, Angular, BootStrap, Web Services REST',
            'description'=>'Vous développez des webservices pour le back-end, vous faites la conception, la manipulation et l’interrogation des bases de données. Vous faites la configuration de l’infrastructure matérielle. Vous contribuez à la rédaction de la documentation technique.',
            'competences'=>'polyvalent,créatif',
            'etat_offre'=>'active',
            'condidat_id'=>null,
            'experience'=>'Entre 1 et 2 ans'


        ]);
        

        $offre->save();
        $offre = new Offre([
            'entreprise_id' =>5,
            'secteur_id' =>7,
            'region_id'=>8,
            'titre'=>'CTA OFFICER',
            'type_contrat'=>'sivp',
            'date_debut'=>'datedebut',
            'diplome'=>'Bac + 1',
            'exigences'=>'Strong knowledge of ICH/GCP guidelines or other relevant guidelines',
            'avantages'=>'avantages',
            'rythme'=>'Plein temps',
            'salaire'=>'salaire',
            'outils'=>'outils',
            'description'=>'Responsible for overall planning and execution of regulatory and ethics submissions for assigned projects/countries (all regions especially Europe)/sites, which may include completion of submissions or notifications, as required',
            'competences'=>'Strong organizational, time management, interpersonal skills.',
            'etat_offre'=>'active',
            'condidat_id'=>null,
            'experience'=>'Entre 2 et 5 ans'


        ]);
        

        $offre->save();//
    }
}
