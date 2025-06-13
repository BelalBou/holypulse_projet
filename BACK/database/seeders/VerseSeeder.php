<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Verse;

class VerseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $verses = [
            [
                'book' => 'Jean',
                'chapter' => 3,
                'verse' => 16,
                'text' => 'Car Dieu a tant aimé le monde qu\'il a donné son Fils unique, afin que quiconque croit en lui ne périsse point, mais qu\'il ait la vie éternelle.'
            ],
            [
                'book' => 'Psaumes',
                'chapter' => 23,
                'verse' => 1,
                'text' => 'L\'Éternel est mon berger: je ne manquerai de rien.'
            ],
            [
                'book' => 'Philippiens',
                'chapter' => 4,
                'verse' => 13,
                'text' => 'Je puis tout par celui qui me fortifie.'
            ],
            [
                'book' => 'Romains',
                'chapter' => 8,
                'verse' => 28,
                'text' => 'Nous savons, du reste, que toutes choses concourent au bien de ceux qui aiment Dieu, de ceux qui sont appelés selon son dessein.'
            ],
            [
                'book' => 'Proverbes',
                'chapter' => 3,
                'verse' => 5,
                'text' => 'Confie-toi en l\'Éternel de tout ton cœur, Et ne t\'appuie pas sur ta sagesse;'
            ],
            [
                'book' => 'Matthieu',
                'chapter' => 28,
                'verse' => 20,
                'text' => 'Et voici, je suis avec vous tous les jours, jusqu\'à la fin du monde.'
            ],
            [
                'book' => 'Jérémie',
                'chapter' => 29,
                'verse' => 11,
                'text' => 'Car je connais les projets que j\'ai formés sur vous, dit l\'Éternel, projets de paix et non de malheur, afin de vous donner un avenir et de l\'espérance.'
            ],
            [
                'book' => '1 Corinthiens',
                'chapter' => 13,
                'verse' => 4,
                'text' => 'La charité est patiente, elle est pleine de bonté; la charité n\'est point envieuse; la charité ne se vante point, elle ne s\'enfle point d\'orgueil,'
            ],
            [
                'book' => 'Esaïe',
                'chapter' => 40,
                'verse' => 31,
                'text' => 'Mais ceux qui se confient en l\'Éternel renouvellent leur force. Ils prennent le vol comme les aigles; Ils courent, et ne se lassent point, Ils marchent, et ne se fatiguent point.'
            ],
            [
                'book' => 'Genèse',
                'chapter' => 1,
                'verse' => 1,
                'text' => 'Au commencement, Dieu créa les cieux et la terre.'
            ]
        ];

        foreach ($verses as $verse) {
            Verse::create($verse);
        }
    }
}
