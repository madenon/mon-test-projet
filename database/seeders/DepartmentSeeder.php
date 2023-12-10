<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['id'=>1, 'department_number'=>'1','name'=> 'Ain', 'chef_id'=> 'Bourg-en-Bresse','region_id' => 24],
            ['id'=>2, 'department_number'=>'2','name'=> 'Aisne', 'chef_id'=> 'Laon','region_id' => 19],
            ['id'=>3, 'department_number'=>'3','name'=> 'Allier', 'chef_id'=> 'Moulins','region_id' => 3],
            ['id'=>4, 'department_number'=>'4','name'=> 'Alpes de Haute-Provence', 'chef_id'=> 'Digne-les-Bains','region_id' => 21],
            ['id'=>5, 'department_number'=>'5','name'=> 'Hautes-Alpes', 'chef_id'=> 'Gap','region_id' => 21],
            ['id'=>6, 'department_number'=>'6','name'=> 'Alpes-Maritimes', 'chef_id'=> 'Nice','region_id' => 21],
            ['id'=>7, 'department_number'=>'7','name'=> 'Ardêche', 'chef_id'=> 'Privas','region_id' => 24],
            ['id'=>8, 'department_number'=>'8','name'=> 'Ardennes', 'chef_id'=> 'Charleville-Mézières','region_id' => 8],
            ['id'=>9, 'department_number'=>'9','name'=> 'Ariège', 'chef_id'=> 'Foix','region_id' => 16],
            ['id'=>10, 'department_number'=>'10','name'=> 'Aube', 'chef_id'=> 'Troyes','region_id' => 8],
            ['id'=>11, 'department_number'=>'11','name'=> 'Aude', 'chef_id'=> 'Carcassonne','region_id' => 13],
            ['id'=>12, 'department_number'=>'12','name'=> 'Aveyron', 'chef_id'=> 'Rodez','region_id' => 16],
            ['id'=>13, 'department_number'=>'13','name'=> 'Bouches-du-Rhône', 'chef_id'=> 'Marseille','region_id' => 21],
            ['id'=>14, 'department_number'=>'14','name'=> 'Calvados', 'chef_id'=> 'Caen','region_id' => 4],
            ['id'=>15, 'department_number'=>'15','name'=> 'Cantal', 'chef_id'=> 'Aurillac','region_id' => 3],
            ['id'=>16, 'department_number'=>'16','name'=> 'Charente', 'chef_id'=> 'Angoulême','region_id' => 20],
            ['id'=>17, 'department_number'=>'17','name'=> 'Charente-Maritime', 'chef_id'=> 'La Rochelle','region_id' => 20],
            ['id'=>18, 'department_number'=>'18','name'=> 'Cher', 'chef_id'=> 'Bourges','region_id' => 7],
            ['id'=>19, 'department_number'=>'19','name'=> 'Corrèze', 'chef_id'=> 'Tulle','region_id' => 14],
            ['id'=>20, 'department_number'=>'2A','name'=> 'Corse-du-Sud', 'chef_id'=> 'Ajaccio','region_id' => 9],
            ['id'=>21, 'department_number'=>'2B','name'=> 'Haute-Corse', 'chef_id'=> 'Bastia','region_id' => 9],
            ['id'=>22, 'department_number'=>'21','name'=> 'Côte-d\'Or', 'chef_id'=> 'Dijon','region_id' => 5],
            ['id'=>23, 'department_number'=>'22','name'=> 'Côtes d\'Armor', 'chef_id'=> 'St-Brieuc','region_id' => 6],
            ['id'=>24, 'department_number'=>'23','name'=> 'Creuse', 'chef_id'=> 'Guéret','region_id' => 14],
            ['id'=>25, 'department_number'=>'24','name'=> 'Dordogne', 'chef_id'=> 'Périgueux','region_id' => 2],
            ['id'=>26, 'department_number'=>'25','name'=> 'Doubs', 'chef_id'=> 'Besançon','region_id' => 10],
            ['id'=>27, 'department_number'=>'26','name'=> 'Drôme', 'chef_id'=> 'Valence','region_id' => 24],
            ['id'=>28, 'department_number'=>'27','name'=> 'Eure', 'chef_id'=> 'Évreux','region_id' => 11],
            ['id'=>29, 'department_number'=>'28','name'=> 'Eure-et-Loir', 'chef_id'=> 'Chartres','region_id' => 7],
            ['id'=>30, 'department_number'=>'29','name'=> 'Finistère', 'chef_id'=> 'Quimper','region_id' => 6],
            ['id'=>31, 'department_number'=>'30','name'=> 'Gard', 'chef_id'=> 'Nîmes','region_id' => 13],
            ['id'=>32, 'department_number'=>'31','name'=> 'Haute-Garonne', 'chef_id'=> 'Toulouse','region_id' => 16],
            ['id'=>33, 'department_number'=>'32','name'=> 'Gers', 'chef_id'=> 'Auch','region_id' => 16],
            ['id'=>34, 'department_number'=>'33','name'=> 'Gironde', 'chef_id'=> 'Bordeaux','region_id' => 2],
            ['id'=>35, 'department_number'=>'34','name'=> 'Hérault', 'chef_id'=> 'Montpellier','region_id' => 13],
            ['id'=>36, 'department_number'=>'35','name'=> 'Îlle-et-Vilaine', 'chef_id'=> 'Rennes','region_id' => 6],
            ['id'=>37, 'department_number'=>'36','name'=> 'Indre', 'chef_id'=> 'Châteauroux','region_id' => 7],        
            ['id'=>38, 'department_number'=>'37','name'=>'Indre-et-Loire', 'chef_id'=> 'Tours','region_id' => 7], // Centre
            ['id'=>39, 'department_number'=>'38','name'=>'Isère', 'chef_id'=> 'Grenoble','region_id' => 22], // Rhône-Alpes
            ['id'=>40, 'department_number'=>'39','name'=>'Jura', 'chef_id'=> 'Lons-le-Saunier','region_id' => 10], // Franche-Comté
            ['id'=>41, 'department_number'=>'40','name'=>'Landes', 'chef_id'=> 'Mont-de-Marsan','region_id' => 2], // Aquitaine
            ['id'=>42, 'department_number'=>'41','name'=>'Loir-et-Cher', 'chef_id'=> 'Blois','region_id' => 7], // Centre
            ['id'=>43, 'department_number'=>'42','name'=>'Loire', 'chef_id'=> 'Saint-Étienne','region_id' => 22], // Rhône-Alpes
            ['id'=>44, 'department_number'=>'43','name'=>'Haute-Loire', 'chef_id'=> 'Le Puy-en-Velay','region_id' => 3], // Auvergne
            ['id'=>45, 'department_number'=>'44','name'=>'Loire-Atlantique', 'chef_id'=> 'Nantes','region_id' => 18], // Pays de la Loire
            ['id'=>46, 'department_number'=>'45','name'=>'Loiret', 'chef_id'=> 'Orléans','region_id' => 7], // Centre
            ['id'=>47, 'department_number'=>'46','name'=>'Lot', 'chef_id'=> 'Cahors','region_id' => 16], // Midi-Pyrénées
            ['id'=>48, 'department_number'=>'47','name'=>'Lot-et-Garonne', 'chef_id'=> 'Agen','region_id' => 2], // Aquitaine
            ['id'=>49, 'department_number'=>'48','name'=>'Lozère', 'chef_id'=> 'Mende','region_id' => 13], // Languedoc-Roussillon
            ['id'=>50, 'department_number'=>'49','name'=>'Maine-et-Loire', 'chef_id'=> 'Angers','region_id' => 18], // Pays de la Loire
            ['id'=>51, 'department_number'=>'50','name'=>'Manche', 'chef_id'=> 'Saint-Lô','region_id' => 4], // Basse-Normandie
            ['id'=>52, 'department_number'=>'51','name'=>'Marne', 'chef_id'=> 'Châlons-en-Champagne','region_id' => 8], // Champagne-Ardenne
            ['id'=>53, 'department_number'=>'52','name'=>'Haute-Marne', 'chef_id'=> 'Chaumont','region_id' => 8], // Champagne-Ardenne
            ['id'=>54, 'department_number'=>'53','name'=>'Mayenne', 'chef_id'=> 'Laval','region_id' => 18], // Pays de la Loire
            ['id'=>55, 'department_number'=>'54','name'=>'Meurthe-et-Moselle', 'chef_id'=> 'Nancy','region_id' => 15], // Lorraine
            ['id'=>56, 'department_number'=>'55','name'=>'Meuse', 'chef_id'=> 'Bar-le-Duc','region_id' => 15], // Lorraine
            ['id'=>57, 'department_number'=>'56','name'=>'Morbihan', 'chef_id'=> 'Vannes','region_id' => 6], // Bretagne
            ['id'=>58, 'department_number'=>'57','name'=>'Moselle', 'chef_id'=> 'Metz','region_id' => 15], // Lorraine    
            ['id'=>59, 'department_number'=>'58','name'=>'Nièvre', 'chef_id'=> 'Nevers','region_id' => 5], // Bourgogne
            ['id'=>60, 'department_number'=>'59','name'=>'Nord', 'chef_id'=> 'Lille','region_id' => 17], // Nord-Pas-de-Calais
            ['id'=>61, 'department_number'=>'60','name'=>'Oise', 'chef_id'=> 'Beauvais','region_id' => 19], // Picardie
            ['id'=>62, 'department_number'=>'61','name'=>'Orne', 'chef_id'=> 'Alençon','region_id' => 4], // Basse-Normandie
            ['id'=>63, 'department_number'=>'62','name'=>'Pas-de-Calais', 'chef_id'=> 'Arras','region_id' => 17], // Nord-Pas-de-Calais
            ['id'=>64, 'department_number'=>'63','name'=>'Puy-de-Dôme', 'chef_id'=> 'Clermont-Ferrand','region_id' => 3], // Auvergne
            ['id'=>65, 'department_number'=>'64','name'=>'Pyrénées-Atlantiques', 'chef_id'=> 'Pau','region_id' => 2], // Aquitaine
            ['id'=>66, 'department_number'=>'65','name'=>'Hautes-Pyrénées', 'chef_id'=> 'Tarbes','region_id' => 16], // Midi-Pyrénées
            ['id'=>67, 'department_number'=>'66','name'=>'Pyrénées-Orientales', 'chef_id'=> 'Perpignan','region_id' => 13], // Languedoc-Roussillon
            ['id'=>68, 'department_number'=>'67','name'=>'Bas-Rhin', 'chef_id'=> 'Strasbourg','region_id' => 1], // Alsace
            ['id'=>69, 'department_number'=>'68','name'=>'Haut-Rhin', 'chef_id'=> 'Colmar','region_id' => 1], // Alsace
            ['id'=>70, 'department_number'=>'69','name'=>'Rhône', 'chef_id'=> 'Lyon','region_id' => 22], // Rhône-Alpes
            ['id'=>71, 'department_number'=>'70','name'=>'Haute-Saône', 'chef_id'=> 'Vesoul','region_id' => 10], // Franche-Comté
            ['id'=>72, 'department_number'=>'71','name'=>'Saône-et-Loire', 'chef_id'=> 'Mâcon','region_id' => 5], // Bourgogne
            ['id'=>73, 'department_number'=>'72','name'=>'Sarthe', 'chef_id'=> 'Le Mans','region_id' => 18], // Pays de la Loire
            ['id'=>74, 'department_number'=>'73','name'=>'Savoie', 'chef_id'=> 'Chambéry','region_id' => 22], // Rhône-Alpes
            ['id'=>75, 'department_number'=>'74','name'=>'Haute-Savoie', 'chef_id'=> 'Annecy','region_id' => 22], // Rhône-Alpes
            ['id'=>76, 'department_number'=>'75','name'=>'Paris', 'chef_id'=> 'Paris','region_id' => 12], // Île-de-France
            ['id'=>77, 'department_number'=>'76','name'=>'Seine-Maritime', 'chef_id'=> 'Rouen','region_id' => 11], // Haute-Normandie
            ['id'=>78, 'department_number'=>'77','name'=>'Seine-et-Marne', 'chef_id'=> 'Melun','region_id' => 12], // Île-de-France
            ['id'=>79, 'department_number'=>'78','name'=>'Yvelines', 'chef_id'=> 'Versailles','region_id' => 12], // Île-de-France
            ['id'=>80, 'department_number'=>'79','name'=>'Deux-Sèvres', 'chef_id'=> 'Niort','region_id' => 20], // Poitou-Charentes
            ['id'=>81, 'department_number'=>'80','name'=>'Somme', 'chef_id'=> 'Amiens','region_id' => 19], // Picardie
            ['id'=>82, 'department_number'=>'81','name'=>'Tarn', 'chef_id'=> 'Albi','region_id' => 16], // Midi-Pyrénées
            ['id'=>83, 'department_number'=>'82','name'=>'Tarn-et-Garonne', 'chef_id'=> 'Montauban','region_id' => 16], // Midi-Pyrénées
            ['id'=>84, 'department_number'=>'83','name'=>'Var', 'chef_id'=> 'Toulon','region_id' => 21], // Provence-Alpes-Côte d'Azur
            ['id'=>85, 'department_number'=>'84','name'=>'Vaucluse', 'chef_id'=> 'Avignon','region_id' => 21], // Provence-Alpes-Côte d'Azur
            ['id'=>86, 'department_number'=>'85','name'=>'Vendée', 'chef_id'=> 'La Roche-sur-Yon','region_id' => 18], // Pays de la Loire
            ['id'=>87, 'department_number'=>'86','name'=>'Vienne', 'chef_id'=> 'Poitiers','region_id' => 20], // Poitou-Charentes
            ['id'=>88, 'department_number'=>'87','name'=>'Haute-Vienne', 'chef_id'=> 'Limoges','region_id' => 14], // Limousin
            ['id'=>89, 'department_number'=>'88','name'=>'Vosges', 'chef_id'=> 'Épinal','region_id' => 15], // Lorraine
            ['id'=>90, 'department_number'=>'89','name'=>'Yonne', 'chef_id'=> 'Auxerre','region_id' => 5], // Bourgogne
            ['id'=>91, 'department_number'=>'90','name'=>'Territoire-de-Belfort', 'chef_id'=> 'Belfort','region_id' => 10], // Franche-Comté
            ['id'=>92, 'department_number'=>'91','name'=>'Essonne', 'chef_id'=> 'Évry','region_id' => 12], // Île-de-France
            ['id'=>93, 'department_number'=>'92','name'=>'Hauts-de-Seine', 'chef_id'=> 'Nanterre','region_id' => 12], // Île-de-France
            ['id'=>94, 'department_number'=>'93','name'=>'Seine-Saint-Denis', 'chef_id'=> 'Bobigny','region_id' => 12], // Île-de-France
            ['id'=>95, 'department_number'=>'94','name'=>'Val-de-Marne', 'chef_id'=> 'Créteil','region_id' => 12], // Île-de-France
            ['id'=>96, 'department_number'=>'95','name'=>'Val-d\'Oise', 'chef_id'=> 'Pontoise','region_id' => 12], // Île-de-France 
        ];
        foreach ($departments as &$item) {
            unset($item['chef_id']);
        }
        Department::insert($departments);
    }
}