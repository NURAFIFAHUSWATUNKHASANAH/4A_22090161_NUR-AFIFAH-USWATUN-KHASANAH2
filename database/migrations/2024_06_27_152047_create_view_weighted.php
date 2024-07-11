<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateViewWeighted extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW view_weighted AS
            SELECT 
                n.id,
                n.nip,
                n.nama,
                n.norm_c1 * k1.bobot AS weighted_c1,
                n.norm_c2 * k2.bobot AS weighted_c2,
                n.norm_c3 * k3.bobot AS weighted_c3,
                n.norm_c4 * k4.bobot AS weighted_c4,
                n.norm_c5 * k5.bobot AS weighted_c5
            FROM 
                view_normalized n
            JOIN 
                kriteria k1 ON k1.kode = 'C1'
            JOIN 
                kriteria k2 ON k2.kode = 'C2'
            JOIN 
                kriteria k3 ON k3.kode = 'C3'
            JOIN 
                kriteria k4 ON k4.kode = 'C4'
            JOIN 
                kriteria k5 ON k5.kode = 'C5';
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS view_weighted");
    }
}
