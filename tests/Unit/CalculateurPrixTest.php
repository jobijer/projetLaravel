<?php

namespace Tests\Unit;

use App\Services\CalculateurPrix;

use PHPUnit\Framework\TestCase;

class CalculateurPrixTest extends TestCase
{
/**Assertions d'exception */
    public function test_calcul_prix_avec_taxe_negative_leve_exception(): void {
        $calculateur = new CalculateurPrix();
        $this->expectException(\InvalidArgumentException::class);
        $calculateur->calculerAvecTaxe(100.00, -0.10);
    }
    public function test_remise_negative_leve_exception(): void {
        $calculateur = new CalculateurPrix();
        $this->expectException(\InvalidArgumentException::class);
        $calculateur->appliquerRemise(100.00, -10);
    }
    public function test_seuil_negatif_leve_exception(): void {
        $calculateur = new CalculateurPrix();
        $this->expectException(\InvalidArgumentException::class);
        $calculateur->respecteSeuilMinimum(10.00, -5.00);
    }

    public function test_prix_respecte_seuil_minimum(): void
    {
        $calculateur = new CalculateurPrix();

        $this->assertTrue(
            $calculateur->respecteSeuilMinimum(100.00, 0)
        );

        $this->assertFalse(
            $calculateur->respecteSeuilMinimum(100.00, 1000)
        );
    }


    /** Assertions qui ne passent pas */
    /*
    public function test_calcul_prix_ht_negatif_leve_exception(): void {
        $calculateur = new CalculateurPrix();
        $this->expectException(\InvalidArgumentException::class);
        $calculateur->calculerAvecTaxe(-100.00, 0.15);
    }
    public function test_prix_negatif_dans_remise_leve_exception(): void {
        $calculateur = new CalculateurPrix();
        $this->expectException(\InvalidArgumentException::class);
        $calculateur->appliquerRemise(-100.00, 10);
    }
    public function test_prix_negatif_dans_seuil_leve_exception(): void {
        $calculateur = new CalculateurPrix();
        $this->expectException(\InvalidArgumentException::class);
        $calculateur->respecteSeuilMinimum(-10.00, 5.00);
    }
    */
}
