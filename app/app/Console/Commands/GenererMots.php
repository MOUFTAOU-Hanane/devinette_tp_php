<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Faker\Factory as Faker;
use App\Models\Word;


class GenererMots extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generer-mots';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $listeMots = [
            'table',
            'fleur',
            'avion',
            'pomme',
            'livre',
            'plage',
            'voile',
            'monte',
            'bruit',
            'lueur',
            'ombre',
            'mange',
            'dents',
            'nuage',
            'fruit',
            'danse',
            'pluie',
            'pieds',
            'rivet',
            'terre',
            'boite',
            'plume',
            'grain',
            'chaud',
            'route',
            'craie',
            'champ',
            'sable',
            'mains',
            'mauve',
            'coeur',
            'brise',
            'câble',
            'jouer',
            'début',
            'court',
            'grand',
            'frais',
            'noble',
            'douce',
            'forme',
            'soupe',
            'singe',
            'début',
            'plage',
            'blanc',
            'chaud',
            'poche',
            'seule',
            'corde',
            'trier',
            'écran',
            'ombre',
            'herbe',
            'faire',
            'riser',
            'salle',
            'soupe',
            'table',
            'verso',
            'zeste',
            'craie',
            'ferme',
            'louer',
            'grain',
            'monte',
            'cheve',
            'poème',
            'plume',
            'rouge',
            'talon',
            'lapin',
            'ruine',
            'table',
            'fumer',
            'sable',
            'paris',
            'idole',
            'ronde',
            'grace',
            'étape',
            'filer',
            'vague',
            'repos',
            'singe',
            'riche',
            'viner',
            'unite',
            'turin',
            'torse',
            'paire',
            'crier',
            'fiche',
            'frime',
            'ronce',
            'étain',
            'notre',
            'entre',
            'gaine',

        ];
        

        $nombreDeMots = count($listeMots);

        for ($i = 0; $i < $nombreDeMots; $i++) {
            $mot = $listeMots[$i];

            // Vérifiez si le mot a exactement 5 caractères


            $date = now()->addDays($i)->toDateString();

                // Enregistrez le mot dans la base de données ou effectuez d'autres actions
                Word::create([
                    'word' => $mot,
                    'date' => $date,
                ]);

                $this->info("Mot à deviner: $mot, Date: $date enregistré.");


                
            if (mb_strlen($mot) === 5) {
                $date = now()->addDays($i)->toDateString();

                // Enregistrez le mot dans la base de données ou effectuez d'autres actions
                Word::create([
                    'word' => $mot,
                    'date' => $date,
                ]);

                $this->info("Mot à deviner: $mot, Date: $date enregistré.");
            }
        }

        $this->info('Génération de mots terminée.');
    }
        //
    }

