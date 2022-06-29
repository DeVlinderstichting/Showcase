<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LanduseTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\LanduseType::create(['name' => 'landusetype_arableFlowering', 'description'=> 'Arable (flowering)']);
        \App\Models\LanduseType::create(['name' => 'landusetype_arableCoverCrop', 'description'=> 'Arable (ley/cover crop)']);
        \App\Models\LanduseType::create(['name' => 'landusetype_arableNonFlowering', 'description'=> 'Arable (non-flowering)']);
        \App\Models\LanduseType::create(['name' => 'landusetype_garden', 'description'=> 'Farmyard/Garden']);
        \App\Models\LanduseType::create(['name' => 'landusetype_fieldMargin', 'description'=> 'Field margin']);
        \App\Models\LanduseType::create(['name' => 'landusetype_grasslandHeavilyFertilised', 'description'=> 'Grasslands - heavily fertilised']);
        \App\Models\LanduseType::create(['name' => 'landusetype_grasslandModeratelyFertilised', 'description'=> 'Grasslands - moderately fertilised']);
        \App\Models\LanduseType::create(['name' => 'landusetype_grasslandSemiNaturalWithChalk', 'description'=> 'Grasslands - semi-natural (chalk)']);
        \App\Models\LanduseType::create(['name' => 'landusetype_grasslandSemiNaturalWithoutChalk', 'description'=> 'Grasslands - semi-natural (excl. chalk)']);
        \App\Models\LanduseType::create(['name' => 'landusetype_hedgerows', 'description'=> 'Hedgerows & hedge banks']);
        \App\Models\LanduseType::create(['name' => 'landusetype_moorsAndHeathlands', 'description'=> 'Moors and heathland']);
        \App\Models\LanduseType::create(['name' => 'landusetype_pondBuffer', 'description'=> 'Riparian & lake/pond buffers']);
        \App\Models\LanduseType::create(['name' => 'landusetype_roadsizeVerge', 'description'=> 'Roadside verge']);
        \App\Models\LanduseType::create(['name' => 'landusetype_fallow', 'description'=> 'Set-aside/fallow']);
        \App\Models\LanduseType::create(['name' => 'landusetype_silveArable', 'description'=> 'Silvo-arable']);
        \App\Models\LanduseType::create(['name' => 'landusetype_silvePastoral', 'description'=> 'Silvo-pastoral']);
        \App\Models\LanduseType::create(['name' => 'landusetype_softFruit', 'description'=> 'Soft fruit plantations (berries)']);
        \App\Models\LanduseType::create(['name' => 'landusetype_nutOrchard', 'description'=> 'Top fruit & nut orchards']);
        \App\Models\LanduseType::create(['name' => 'landusetype_traditionalWoodland', 'description'=> 'Transitional woodland-shrub']);
        \App\Models\LanduseType::create(['name' => 'landusetype_vineyards', 'description'=> 'Vineyards']);
        \App\Models\LanduseType::create(['name' => 'landusetype_woodlandBroadleaf', 'description'=> 'Woodland - broadleaf']);
        \App\Models\LanduseType::create(['name' => 'landusetype_woodlandConifer', 'description'=> 'Woodland - conifer']);
        \App\Models\LanduseType::create(['name' => 'landusetype_woodlandMixed', 'description'=> 'Woodland - mixed broadleaf & conifer']);
        \App\Models\LanduseType::create(['name' => 'landusetype_other', 'description'=> 'Other']);
        \App\Models\LanduseType::create(['name' => 'landusetype_agroForestry', 'description'=> 'Agro-forestry']);
        \App\Models\LanduseType::create(['name' => 'landusetype_fruitAndBerryPlantation', 'description'=> 'Fruit trees and berry plantations']);
        \App\Models\LanduseType::create(['name' => 'landusetype_dehesa', 'description'=> 'Dehesa']);
        \App\Models\LanduseType::create(['name' => 'landusetype_semiNaturalGrassland', 'description'=> 'Grasslands - semi-natural']);
        \App\Models\LanduseType::create(['name' => 'landusetype_shrubland', 'description'=> 'Shrubland']);
        \App\Models\LanduseType::create(['name' => 'landusetype_oliveGroves', 'description'=> 'Olive groves']);
        \App\Models\LanduseType::create(['name' => 'landusetype_permanentlyIrrigatedLand', 'description'=> 'Permanently irrigated land']);
        \App\Models\LanduseType::create(['name' => 'landusetype_riceFields', 'description'=> 'Rice fields']);
        \App\Models\LanduseType::create(['name' => 'landusetype_sclerophyllousVegetation', 'description'=> 'Sclerophyllous vegetation']);
        \App\Models\LanduseType::create(['name' => 'landusetype_smallScaleCultivationPatterns', 'description'=> 'Small-scale cultivation patterns']);
        \App\Models\LanduseType::create(['name' => 'landusetype_woodlandShrub', 'description'=> 'Transitional woodland-shrub']);
        \App\Models\LanduseType::create(['name' => 'landusetype_woodland', 'description'=> 'Woodland']);
        \App\Models\LanduseType::create(['name' => 'landusetype_arableNaturalFertilizer', 'description'=> 'Arabale field (with natural fertiliser)']);
        \App\Models\LanduseType::create(['name' => 'landusetype_arableFieldMarginWithFlowers', 'description'=> 'Arabale field margin with flowers']);
        \App\Models\LanduseType::create(['name' => 'landusetype_orchard', 'description'=> 'Orchard']);
        \App\Models\LanduseType::create(['name' => 'landusetype_woodlandEdge', 'description'=> 'Woodland edge']);
        \App\Models\LanduseType::create(['name' => 'landusetype_agriculturalGrassland', 'description'=> 'agricultural grassland']);
        \App\Models\LanduseType::create(['name' => 'landusetype_heathland', 'description'=> 'Heathland']);
        \App\Models\LanduseType::create(['name' => 'landusetype_waterbuffer', 'description'=> 'Waterbuffer']);
    }
}
