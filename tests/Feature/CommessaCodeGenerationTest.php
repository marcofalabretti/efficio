<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Commessa;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommessaCodeGenerationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Crea utenti e clienti necessari per i test
        $this->user = User::factory()->create();
        $this->customer = Customer::factory()->create();
    }

    /** @test */
    public function it_generates_correct_code_for_new_commessa()
    {
        $commessa = Commessa::create([
            'nome' => 'Test Commessa',
            'stato' => 'attiva',
            'data_inizio' => now(),
            'customer_id' => $this->customer->id,
            'created_by' => $this->user->id,
        ]);

        $this->assertEquals('1/' . now()->year, $commessa->codice);
    }



    /** @test */
    public function it_increments_counter_for_same_year()
    {
        // Crea prima commessa
        Commessa::create([
            'nome' => 'Prima Commessa',
            'stato' => 'attiva',
            'data_inizio' => now(),
            'customer_id' => $this->customer->id,
            'created_by' => $this->user->id,
        ]);

        // Crea seconda commessa
        $secondaCommessa = Commessa::create([
            'nome' => 'Seconda Commessa',
            'stato' => 'attiva',
            'data_inizio' => now(),
            'customer_id' => $this->customer->id,
            'created_by' => $this->user->id,
        ]);

        $this->assertEquals('2/' . now()->year, $secondaCommessa->codice);
    }

    /** @test */
    public function it_uses_current_year_for_code_generation()
    {
        // Crea commessa per l'anno corrente
        Commessa::create([
            'nome' => 'Commessa Anno Corrente',
            'stato' => 'attiva',
            'data_inizio' => now(),
            'customer_id' => $this->customer->id,
            'created_by' => $this->user->id,
        ]);

        // Simula commessa per l'anno prossimo (ma creata nell'anno corrente)
        $nextYear = now()->addYear();
        $commessaNextYear = Commessa::create([
            'nome' => 'Commessa Anno Prossimo',
            'stato' => 'attiva',
            'data_inizio' => $nextYear,
            'customer_id' => $this->customer->id,
            'created_by' => $this->user->id,
        ]);

        // Il codice dovrebbe usare l'anno corrente (anno di creazione)
        $this->assertEquals('2/' . now()->year, $commessaNextYear->codice);
    }

    /** @test */
    public function it_does_not_require_codice_in_fillable()
    {
        $commessa = Commessa::create([
            'nome' => 'Test Commessa',
            'stato' => 'attiva',
            'data_inizio' => now(),
            'customer_id' => $this->customer->id,
            'created_by' => $this->user->id,
        ]);

        $this->assertNotNull($commessa->codice);
        $this->assertStringContainsString('/', $commessa->codice);
    }
}
