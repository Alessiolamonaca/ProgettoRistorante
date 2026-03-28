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

        Dish::create([
            'category_id'    => $antipasti->id,
            'position'       => 3,
            'price'          => 9.00,
            'name_it'        => 'Bruschette miste',
            'name_en'        => 'Mixed bruschetta',
            'name_de'        => 'Gemischte Bruschetta',
            'name_es'        => 'Bruschettas mixtas',
            'name_fr'        => 'Bruschettas variées',
            'description_it' => 'Pane tostato con pomodoro, olive e crema di formaggio.',
            'description_en' => 'Toasted bread with tomato, olives and cheese cream.',
            'description_de' => 'Geröstetes Brot mit Tomaten, Oliven und Käsecreme.',
            'description_es' => 'Pan tostado con tomate, aceitunas y crema de queso.',
            'description_fr' => 'Pain grillé avec tomate, olives et crème de fromage.',
        ]);
        
        Dish::create([
            'category_id'    => $antipasti->id,
            'position'       => 4,
            'price'          => 11.00,
            'name_it'        => 'Pallotte cacio e ova',
            'name_en'        => 'Cheese and egg balls',
            'name_de'        => 'Käse-Ei-Bällchen',
            'name_es'        => 'Albóndigas de queso y huevo',
            'name_fr'        => 'Boulettes au fromage et aux œufs',
            'description_it' => 'Piatto tipico abruzzese servito con salsa al pomodoro.',
            'description_en' => 'Traditional Abruzzese dish served with tomato sauce.',
            'description_de' => 'Typisches Gericht aus den Abruzzen mit Tomatensauce.',
            'description_es' => 'Plato típico de Abruzzo servido con salsa de tomate.',
            'description_fr' => 'Plat typique des Abruzzes servi avec sauce tomate.',
        ]);
        
        Dish::create([
            'category_id'    => $antipasti->id,
            'position'       => 5,
            'price'          => 8.00,
            'name_it'        => 'Verdure grigliate di stagione',
            'name_en'        => 'Seasonal grilled vegetables',
            'name_de'        => 'Gegrilltes Saisongemüse',
            'name_es'        => 'Verduras de temporada a la parrilla',
            'name_fr'        => 'Légumes de saison grillés',
            'description_it' => 'Selezione di ortaggi grigliati con olio extravergine.',
            'description_en' => 'Selection of grilled vegetables with extra virgin olive oil.',
            'description_de' => 'Auswahl an gegrilltem Gemüse mit nativem Olivenöl extra.',
            'description_es' => 'Selección de verduras a la parrilla con aceite de oliva virgen extra.',
            'description_fr' => 'Sélection de légumes grillés à l’huile d’olive extra vierge.',
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

        Dish::create([
            'category_id'    => $primi->id,
            'position'       => 3,
            'price'          => 13.00,
            'name_it'        => 'Chitarra al ragù abruzzese',
            'name_en'        => 'Chitarra pasta with Abruzzese meat sauce',
            'name_de'        => 'Chitarra-Nudeln mit Abruzzen-Ragout',
            'name_es'        => 'Pasta chitarra con ragú abruzzese',
            'name_fr'        => 'Pâtes chitarra au ragù des Abruzzes',
            'description_it' => 'Pasta fresca con sugo tradizionale di carne.',
            'description_en' => 'Fresh pasta with traditional meat sauce.',
            'description_de' => 'Frische Pasta mit traditioneller Fleischsauce.',
            'description_es' => 'Pasta fresca con salsa tradicional de carne.',
            'description_fr' => 'Pâtes fraîches avec sauce traditionnelle à la viande.',
        ]);
        
        Dish::create([
            'category_id'    => $primi->id,
            'position'       => 4,
            'price'          => 15.00,
            'name_it'        => 'Gnocchi al sugo di castrato',
            'name_en'        => 'Gnocchi with mutton sauce',
            'name_de'        => 'Gnocchi mit Hammelsauce',
            'name_es'        => 'Ñoquis con salsa de carnero',
            'name_fr'        => 'Gnocchis avec sauce de mouton',
            'description_it' => 'Piatto rustico dal sapore intenso della tradizione locale.',
            'description_en' => 'Rustic local dish with a rich traditional flavour.',
            'description_de' => 'Rustikales lokales Gericht mit kräftigem traditionellem Geschmack.',
            'description_es' => 'Plato rústico local con sabor intenso y tradicional.',
            'description_fr' => 'Plat rustique local au goût intense et traditionnel.',
        ]);
        
        Dish::create([
            'category_id'    => $primi->id,
            'position'       => 5,
            'price'          => 12.00,
            'name_it'        => 'Sagne e ceci',
            'name_en'        => 'Sagne pasta with chickpeas',
            'name_de'        => 'Sagne mit Kichererbsen',
            'name_es'        => 'Sagne con garbanzos',
            'name_fr'        => 'Sagne aux pois chiches',
            'description_it' => 'Primo semplice e genuino della cucina contadina.',
            'description_en' => 'Simple and genuine traditional countryside first course.',
            'description_de' => 'Einfaches und echtes traditionelles Bauerngericht.',
            'description_es' => 'Primer plato sencillo y auténtico de la cocina campesina.',
            'description_fr' => 'Premier plat simple et authentique de la cuisine paysanne.',
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

        Dish::create([
            'category_id'    => $secondi->id,
            'position'       => 3,
            'price'          => 18.00,
            'name_it'        => 'Arrosticini di pecora',
            'name_en'        => 'Traditional lamb skewers',
            'name_de'        => 'Traditionelle Schafspieße',
            'name_es'        => 'Brochetas tradicionales de cordero',
            'name_fr'        => 'Brochettes traditionnelles d’agneau',
            'description_it' => 'Specialità abruzzese cotta alla brace e servita calda.',
            'description_en' => 'Traditional Abruzzese speciality cooked on the grill and served hot.',
            'description_de' => 'Traditionelle Spezialität aus den Abruzzen, gegrillt und heiß serviert.',
            'description_es' => 'Especialidad tradicional de Abruzzo cocinada a la brasa y servida caliente.',
            'description_fr' => 'Spécialité traditionnelle des Abruzzes cuite au gril et servie chaude.',
        ]);
        
        Dish::create([
            'category_id'    => $secondi->id,
            'position'       => 4,
            'price'          => 19.00,
            'name_it'        => 'Agnello alla brace',
            'name_en'        => 'Grilled lamb',
            'name_de'        => 'Lamm vom Grill',
            'name_es'        => 'Cordero a la parrilla',
            'name_fr'        => 'Agneau grillé',
            'description_it' => 'Carne tenera e saporita, cotta secondo tradizione.',
            'description_en' => 'Tender and flavourful meat, grilled in traditional style.',
            'description_de' => 'Zartes und aromatisches Fleisch, traditionell gegrillt.',
            'description_es' => 'Carne tierna y sabrosa, cocinada según la tradición.',
            'description_fr' => 'Viande tendre et savoureuse, cuite selon la tradition.',
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

        Dish::create([
            'category_id'    => $dessert->id,
            'position'       => 3,
            'price'          => 6.00,
            'name_it'        => 'Panna cotta ai frutti di bosco',
            'name_en'        => 'Panna cotta with berries',
            'name_de'        => 'Panna cotta mit Waldbeeren',
            'name_es'        => 'Panna cotta con frutos rojos',
            'name_fr'        => 'Panna cotta aux fruits rouges',
            'description_it' => 'Dessert delicato servito con salsa ai frutti di bosco.',
            'description_en' => 'Delicate dessert served with berry sauce.',
            'description_de' => 'Feines Dessert mit Waldbeerensauce.',
            'description_es' => 'Postre delicado servido con salsa de frutos rojos.',
            'description_fr' => 'Dessert délicat servi avec sauce aux fruits rouges.',
        ]);
        
        Dish::create([
            'category_id'    => $dessert->id,
            'position'       => 4,
            'price'          => 5.50,
            'name_it'        => 'Crostata della casa',
            'name_en'        => 'Homemade tart',
            'name_de'        => 'Hausgemachte Tarte',
            'name_es'        => 'Tarta casera',
            'name_fr'        => 'Tarte maison',
            'description_it' => 'Pasta frolla con confettura artigianale.',
            'description_en' => 'Shortcrust pastry filled with homemade jam.',
            'description_de' => 'Mürbeteig mit hausgemachter Konfitüre.',
            'description_es' => 'Masa quebrada con mermelada casera.',
            'description_fr' => 'Pâte sablée garnie de confiture maison.',
        ]);
    }
}
