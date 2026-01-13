<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Dish;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================
        // CATEGORIE
        // ==========================

        $antipasti = Category::create([
            'slug'     => 'antipasti',
            'position' => 1,
            'name_it'  => 'Antipasti',
            'name_en'  => 'Starters',
            'name_de'  => 'Vorspeisen',
            'name_es'  => 'Entrantes',
            'name_fr'  => 'Entrées',
        ]);

        $primi = Category::create([
            'slug'     => 'primi',
            'position' => 2,
            'name_it'  => 'Primi piatti',
            'name_en'  => 'First courses',
            'name_de'  => 'Erste Gänge',
            'name_es'  => 'Primeros platos',
            'name_fr'  => 'Premiers plats',
        ]);

        $secondi = Category::create([
            'slug'     => 'secondi',
            'position' => 3,
            'name_it'  => 'Secondi piatti',
            'name_en'  => 'Main courses',
            'name_de'  => 'Hauptgerichte',
            'name_es'  => 'Segundos platos',
            'name_fr'  => 'Plats principaux',
        ]);

        $dessert = Category::create([
            'slug'     => 'dessert',
            'position' => 4,
            'name_it'  => 'Dessert',
            'name_en'  => 'Desserts',
            'name_de'  => 'Desserts',
            'name_es'  => 'Postres',
            'name_fr'  => 'Desserts',
        ]);

        // ==========================
        // ANTIPASTI
        // ==========================

        Dish::create([
            'category_id'    => $antipasti->id,
            'position'       => 1,
            'price'          => 16.00,
            'name_it'        => 'Antipasto di mare della casa',
            'name_en'        => 'House seafood starter',
            'name_de'        => 'Vorspeise mit Meeresfrüchten des Hauses',
            'name_es'        => 'Entrante de marisco de la casa',
            'name_fr'        => 'Entrée de fruits de mer de la maison',
            'description_it' => 'Selezione di pesce del giorno, servito tiepido.',
            'description_en' => 'Selection of today’s seafood, served warm.',
            'description_de' => 'Auswahl des Fisches des Tages, lauwarm serviert.',
            'description_es' => 'Selección de pescado del día, servido templado.',
            'description_fr' => 'Sélection de poisson du jour, servie tiède.',
        ]);

        Dish::create([
            'category_id'    => $antipasti->id,
            'position'       => 2,
            'price'          => 12.00,
            'name_it'        => 'Tagliere di salumi e formaggi',
            'name_en'        => 'Cured meats and cheese board',
            'name_de'        => 'Aufschnitt- und Käseplatte',
            'name_es'        => 'Tabla de embutidos y quesos',
            'name_fr'        => 'Plateau de charcuterie et fromages',
            'description_it' => 'Prodotti selezionati del territorio.',
            'description_en' => 'Selection of local products.',
            'description_de' => 'Auswahl regionaler Produkte.',
            'description_es' => 'Productos seleccionados del territorio.',
            'description_fr' => 'Produits du terroir sélectionnés.',
        ]);

        // ==========================
        // PRIMI
        // ==========================

        Dish::create([
            'category_id'    => $primi->id,
            'position'       => 1,
            'price'          => 14.00,
            'name_it'        => 'Spaghetti alle vongole',
            'name_en'        => 'Spaghetti with clams',
            'name_de'        => 'Spaghetti mit Venusmuscheln',
            'name_es'        => 'Espaguetis con almejas',
            'name_fr'        => 'Spaghetti aux palourdes',
            'description_it' => 'Classico della tradizione, con vongole fresche.',
            'description_en' => 'Traditional dish with fresh clams.',
            'description_de' => 'Klassisches Gericht mit frischen Venusmuscheln.',
            'description_es' => 'Clásico de la tradición con almejas frescas.',
            'description_fr' => 'Classique de la tradition, avec des palourdes fraîches.',
        ]);

        Dish::create([
            'category_id'    => $primi->id,
            'position'       => 2,
            'price'          => 13.00,
            'name_it'        => 'Risotto del giorno',
            'name_en'        => 'Risotto of the day',
            'name_de'        => 'Risotto des Tages',
            'name_es'        => 'Risotto del día',
            'name_fr'        => 'Risotto du jour',
            'description_it' => 'Preparato con ingredienti di stagione.',
            'description_en' => 'Prepared with seasonal ingredients.',
            'description_de' => 'Mit saisonalen Zutaten zubereitet.',
            'description_es' => 'Preparado con ingredientes de temporada.',
            'description_fr' => 'Préparé avec des ingrédients de saison.',
        ]);

        // ==========================
        // SECONDI
        // ==========================

        Dish::create([
            'category_id'    => $secondi->id,
            'position'       => 1,
            'price'          => 22.00,
            'name_it'        => 'Grigliata mista di pesce',
            'name_en'        => 'Mixed grilled fish',
            'name_de'        => 'Gemischter Fisch vom Grill',
            'name_es'        => 'Parrillada mixta de pescado',
            'name_fr'        => 'Grillade mixte de poisson',
            'description_it' => 'Pesce selezionato, cotto alla griglia.',
            'description_en' => 'Selected fish, grilled.',
            'description_de' => 'Ausgewählter Fisch vom Grill.',
            'description_es' => 'Pescado seleccionado, a la parrilla.',
            'description_fr' => 'Poisson sélectionné, cuit au grill.',
        ]);

        Dish::create([
            'category_id'    => $secondi->id,
            'position'       => 2,
            'price'          => 20.00,
            'name_it'        => 'Tagliata di manzo',
            'name_en'        => 'Sliced beef steak',
            'name_de'        => 'Rinder-Tagliata',
            'name_es'        => 'Tagliata de ternera',
            'name_fr'        => 'Tagliata de bœuf',
            'description_it' => 'Servita con rucola e scaglie di grana.',
            'description_en' => 'Served with rocket and parmesan shavings.',
            'description_de' => 'Serviert mit Rucola und Parmesanhobeln.',
            'description_es' => 'Servida con rúcula y lascas de parmesano.',
            'description_fr' => 'Servie avec roquette et copeaux de parmesan.',
        ]);

        // ==========================
        // DESSERT
        // ==========================

        Dish::create([
            'category_id'    => $dessert->id,
            'position'       => 1,
            'price'          => 6.00,
            'name_it'        => 'Tiramisù della casa',
            'name_en'        => 'Homemade tiramisù',
            'name_de'        => 'Hausgemachtes Tiramisu',
            'name_es'        => 'Tiramisú de la casa',
            'name_fr'        => 'Tiramisu maison',
            'description_it' => 'Ricetta tradizionale.',
            'description_en' => 'Traditional recipe.',
            'description_de' => 'Traditionelles Rezept.',
            'description_es' => 'Receta tradicional.',
            'description_fr' => 'Recette traditionnelle.',
        ]);

        Dish::create([
            'category_id'    => $dessert->id,
            'position'       => 2,
            'price'          => 6.00,
            'name_it'        => 'Dolce del giorno',
            'name_en'        => 'Dessert of the day',
            'name_de'        => 'Dessert des Tages',
            'name_es'        => 'Postre del día',
            'name_fr'        => 'Dessert du jour',
            'description_it' => 'Chiedi in sala la proposta del giorno.',
            'description_en' => 'Ask our staff for today’s dessert.',
            'description_de' => 'Fragen Sie den Service nach dem Dessert des Tages.',
            'description_es' => 'Pregunta en sala por la propuesta del día.',
            'description_fr' => 'Demandez en salle le dessert du jour.',
        ]);
    }
}
