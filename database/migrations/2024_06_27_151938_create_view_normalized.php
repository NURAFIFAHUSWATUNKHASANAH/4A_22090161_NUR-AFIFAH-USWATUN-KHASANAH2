<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateViewNormalized extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW view_normalized AS
            SELECT 
                id,
                nip,
                nama,
                c1 / SQRT(SUM(c1 * c1) OVER()) AS norm_c1,
                c2 / SQRT(SUM(c2 * c2) OVER()) AS norm_c2,
                c3 / SQRT(SUM(c3 * c3) OVER()) AS norm_c3,
                c4 / SQRT(SUM(c4 * c4) OVER()) AS norm_c4,
                c5 / SQRT(SUM(c5 * c5) OVER()) AS norm_c5
            FROM 
                alternatif;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS view_normalized");
    }
}
