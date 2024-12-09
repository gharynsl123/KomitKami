<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InventorySedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rawData = [
            ['kode_barang' =>'BB-BRILIANT BLUE' , 'nama_barang'=>'Brilliant Blue' ],
            ['kode_barang' =>'BB-TARTRAZINE' , 'nama_barang'=>'Tartrazine' ],
            ['kode_barang' =>'BB-EDTA 2NA' , 'nama_barang'=>'Na 2EDTA' ],
            ['kode_barang' =>'BB-Glis' , 'nama_barang'=>'Gliserin' ],
            ['kode_barang' =>'BB-PHOS' , 'nama_barang'=>'Phosphoric Acid' ],
            ['kode_barang' =>'BB-SUPERSHIELD GD50' , 'nama_barang'=>'Supershield GD50' ],
            ['kode_barang' =>'BB-CHG' , 'nama_barang'=>'CHG'],
            ['kode_barang' =>'BB-MEDLEY' , 'nama_barang'=>'Meddley Plus'],
            ['kode_barang' =>'BB-SILICONE ANTIFOAM' , 'nama_barang'=>'Antifoam'],
            ['kode_barang' =>'BB-DDAC 80%' , 'nama_barang'=>'DDAC'],
            ['kode_barang' =>'BK-011' , 'nama_barang'=>'Troycare'],
            ['kode_barang' =>'BB- PARFUME MINT & SPIRIT' , 'nama_barang'=>'Mind & Spirit' ],
            ['kode_barang' =>'BB-BEROL 226SA' , 'nama_barang'=>'Berrol' ],
            ['kode_barang' =>'BB-Carm' , 'nama_barang'=>'Carmoisine' ],
            ['kode_barang' =>'BB-NINO' , 'nama_barang'=>'Ninol'],
            ['kode_barang' =>'BB-CITR' , 'nama_barang'=>'Citric Acid' ],
            ['kode_barang' =>'BB-NATR' , 'nama_barang'=>'Natrosol' ],
            ['kode_barang' =>'BB-AMMO' , 'nama_barang'=>'Ammonyx' ],
            ['kode_barang' =>'BB-TEA' , 'nama_barang'=>'TEA' ],
            ['kode_barang' =>'BB-ISOP' , 'nama_barang'=>'IPA' ],
            ['kode_barang' =>'BB-Silver' , 'nama_barang'=>'Silver Solution' ],
            ['kode_barang' =>'BB-PARFUME RED ROSE' , 'nama_barang'=>'Red Rose'],
            ['kode_barang' =>'BB-ETHANOL' , 'nama_barang'=>'Ethanol'],
            ['kode_barang' =>'BB-H202 50 %' , 'nama_barang'=>'H2O2'],
            ['kode_barang' =>'BB-BKC' , 'nama_barang'=>'BKC'],
            ['kode_barang' =>'BB-SUPERSURF LPAO' , 'nama_barang'=>'Supersurf LPAO 30'],
            ['kode_barang' =>'BB-SODIUM FORMATE' , 'nama_barang'=>'Na Format' ],
            ['kode_barang' =>'BB-TAGAT CH40' , 'nama_barang'=>'Tagat CH40' ],
            ['kode_barang' =>'BB-ALOE' , 'nama_barang'=>'Aloevera' ],
            ['kode_barang' =>'BB-NAOH' , 'nama_barang'=>'NaOH'],
            ['kode_barang' =>'BB-ACE' , 'nama_barang'=>'Acecare' ],
            ['kode_barang' =>'BB-RHEOSOLVE D 5S' , 'nama_barang'=>'Rheosolve D5S' ],
            ['kode_barang' =>'BK-033' , 'nama_barang'=>'Formalin' ],
            ['kode_barang' =>'BB-AMP95' , 'nama_barang'=>'AMP 95' ],
            ['kode_barang' =>'BK-035' , 'nama_barang'=>'Sampel Anios AD' ],
            ['kode_barang' =>'BB-GREENTEA' , 'nama_barang'=>'Parfum Green Tea' ],
            ['kode_barang' =>'BP-CARTON BOX ALKESSI JERIGEN 5L' , 'nama_barang'=>'Master Box 5 L (Alkessi)'],
            ['kode_barang' =>'KMS-038' , 'nama_barang'=>'Master Box 5 L 750 mL (Alkessi)'],
            ['kode_barang' =>'KMS-039' , 'nama_barang'=>'Master Box 500 mL (Alkessi)'],
            ['kode_barang' =>'KMS-040' , 'nama_barang'=>'Master Box 500 mL (Alkessi Hand Rub)'],
            ['kode_barang' =>'BP-JER5L' , 'nama_barang'=>'Jerigen Natural 5 L'],
            ['kode_barang' =>'BP-JERPUT 5L' , 'nama_barang'=>'Jerigen Susu 5 L' ],
            ['kode_barang' =>'KMS-043' , 'nama_barang'=>'Tutup Jerigen 5 L' ],
            ['kode_barang' =>'BP-PUMPBTL500ML' , 'nama_barang'=>'Pump Polos 500 mL' ],
            ['kode_barang' =>'BP - BTL500ML' , 'nama_barang'=>'Botol Polos 500 mL'],
            ['kode_barang' =>'KMS-046' , 'nama_barang'=>'Tutup Botol Polos 500 mL' ],
            ['kode_barang' =>'KMS-047' , 'nama_barang'=>'Botol Spray 500 mL' ],
            ['kode_barang' =>'BP-BTL750ML' , 'nama_barang'=>'Botol Spray 750 mL' ],
            ['kode_barang' =>'KMS-049' , 'nama_barang'=>'Spray 500 mL / 750 mL' ],
            ['kode_barang' =>'KMS-050' , 'nama_barang'=>'Master Box 5 L (Chrona)' ],
            ['kode_barang' =>'KMS-051' , 'nama_barang'=>'Master Box 500 mL (Chrona)' ],
            ['kode_barang' =>'KMS-052' , 'nama_barang'=>'Jerigen 5 L ( Chrona )'],
            ['kode_barang' =>'KMS-053' , 'nama_barang'=>'Tutup Jerigen 5 L ( Chrona )'],
            ['kode_barang' =>'KMS-054' , 'nama_barang'=>'Tutup Dalam Jerigen 5 L ( Chrona )'],
            ['kode_barang' =>'BP-BTL500ML Medizsisma' , 'nama_barang'=>'Botol Medizsisma 500 mL'],
            ['kode_barang' =>'KMS-056' , 'nama_barang'=>'Pump Medizsisma 500 mL'],
            ['kode_barang' =>'KMS-057' , 'nama_barang'=>'Braked Bad Medizsima' ],
            ['kode_barang' =>'KMS-058' , 'nama_barang'=>'Braked Dinding Medizsima' ],
            ['kode_barang' =>'KMS-059' , 'nama_barang'=>'Braked Dinding Polos' ],
            ['kode_barang' =>'BP - Carton Box 5L Medizsisma' , 'nama_barang'=>'Master Box 5 L (Medizsisma)'],
            ['kode_barang' =>'BP - Carton Box 500ML Medizsisma' , 'nama_barang'=>'Master Box 500 mL (Medizsisma)' ],
            ['kode_barang' =>'BP - Carton Box 100ML Medizsisma' , 'nama_barang'=>'Master Box 100 mL (Medizsisma)'],
            ['kode_barang' =>'KMS-063' , 'nama_barang'=>'Botol Spray Medizsisma 100 mL'],
            ['kode_barang' =>'KMS-064' , 'nama_barang'=>'Tutup Botol Spray Medizsisma 100 mL'],
            ['kode_barang' =>'KMS-065' , 'nama_barang'=>'Botol Fliptop Medizsisma 100 mL'],
            ['kode_barang' =>'KMS-066' , 'nama_barang'=>'Tutup Botol Spray Medizsisma 100 mL'],
            ['kode_barang' =>'BP-LABEL ALKESSI GLU 5L' , 'nama_barang'=>'Label Alkessi Glu 5 L' ],
            ['kode_barang' =>'BP-LABEL ALKESSI DESAS 5 LITER' , 'nama_barang'=>'Label Alkessi DesSAS 5 L' ],
            ['kode_barang' =>'BP-LABEL ALKESSI DESCLEANZYME 5L' , 'nama_barang'=>'Label Alkessi DesCleanzyme 5 L' ],
            ['kode_barang' =>'BP-LABEL ALKESSI DESSURF 5L' , 'nama_barang'=>'Label Alkessi DesSurf 5 L'],
            ['kode_barang' =>'BP-LABEL Hand Scrub Alkessi 5L' , 'nama_barang'=>'Label Alkessi Hand Scrub 5 L' ],
            ['kode_barang' =>'BP-Label Hand Scrub Alkessi 500ml' , 'nama_barang'=>'Label Alkessi Hand Scrub 500 mL'],
            ['kode_barang' =>'BP-LABEL ALKESSI CLEANZYME 5L' , 'nama_barang'=>'Label Alkessi Cleanzyme 5 L'],
            ['kode_barang' =>'BP-LABEL ALKESSI SURF 750 ML' , 'nama_barang'=>'Label Alkessi Surf 750 mL'],
            ['kode_barang' =>'BP-LABEL ALKESSI SURF 500ML' , 'nama_barang'=>'Label Alkessi Surf 500 mL'],
            ['kode_barang' =>'BP-LABEL ALKESSI RINSE AID' , 'nama_barang'=>'Label Alkessi Rinse Aid 5 L'],
            ['kode_barang' =>'BP-LABEL ALKESSI RUB 5 L' , 'nama_barang'=>'Label Alkessi Hand Rub 5 L' ],
            ['kode_barang' =>'BP-LABEL ALKESSI RUB 500ML' , 'nama_barang'=>'Label Alkessi Hand Rub 500 mL' ],
            ['kode_barang' =>'BP-LABEL Hand Rub Chrona care 5000ML' , 'nama_barang'=>'Label Chrona Care Hand Rub 5 L' ],
            ['kode_barang' =>'BP - LABEL HAND RUB CHRONA CARE 500ML' , 'nama_barang'=>'Label Chrona Care Hand Rub 500 mL'],
            ['kode_barang' =>'BP - LABEL HAND SCRUB CHRONA CARE 500ML' , 'nama_barang'=>'Label Chrona Care Hand Scrub 500 mL' ],
            ['kode_barang' =>'BP-LABEL Hand Scrub Chrona care 5L' , 'nama_barang'=>'Label Chrona Care Hand Scrub 5 L'],
            ['kode_barang' =>'BP-LABEL Hand Rub Medizsisma 5000ML' , 'nama_barang'=>'Label Medizsisma Hand Rub 5 L'],
            ['kode_barang' =>'BP - LABEL Hand Rub 500ML Medizsisma' , 'nama_barang'=>'Label Medizsisma Hand Rub 500 mL'],
            ['kode_barang' =>'LBL-085' , 'nama_barang'=>'Label Medizsisma Hand Scrub 100 mL'],
            ['kode_barang' =>'BP - Label Hand Scrub 500ML Medizsisma' , 'nama_barang'=>'Label Medizsisma Hand Scrub 500 mL'],
            ['kode_barang' =>'BP - Label Hand Scrub 5000ML Medizsisma' , 'nama_barang'=>'Label Medizsisma Hand Scrub 5 L' ],
            ['kode_barang' =>'BP-LABEL Hand Rub Gel Medizsisma 100ML' , 'nama_barang'=>'Label Medizsisma Hand Gel 100 mL' ],
            ['kode_barang' =>'BP-LABEL Hand Rub Gel Medizsisma 500ML' , 'nama_barang'=>'Label Medizsisma Hand Gel 500 mL' ],
            ['kode_barang' =>'BP-LABEL Hand Rub Gel Medizsisma 5000ML' , 'nama_barang'=>'Label Medizsisma Hand Gel 5 L' ],
        ];

        foreach ($rawData as $data) {
            DB::table('inventory')->insert([
                'code' => $data['kode_barang'],
                'name' => $data['nama_barang'],
                'slug' => Str::slug($data['kode_barang']),
                'created_at' => now()
            ]);
        }
    }
}