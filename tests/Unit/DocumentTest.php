<?php
// tests/Unit/DocumentTest.php

namespace Tests\Unit;

use App\Models\Categories\CategoryModel;
use Tests\TestCase;
use App\Models\Documents\DocumentModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;

class DocumentTest extends TestCase
{
    //use RefreshDatabase;

    /** @test */
    public function testContentsFieldHasLengthLimit()
    {
        // Vamos definir um limite de 255 caracteres para o campo contents
        $maxLength = 255;

        $longContent = str_repeat('A', $maxLength);
        $category = CategoryModel::factory()->create();

        // Criando o documento com conteúdo válido (tamanho <= 255)
        $document = DocumentModel::create([
            'category_id' => $category->id,
            'title' => 'Título do Documento',
            'contents' => $longContent
        ]);

        $this->assertDatabaseHas('documents', [
            'id' => $document->id,
            'contents' => $longContent,
        ]);

        // Testando conteúdo maior que o limite de 255 caracteres
        $this->expectException(ValidationException::class);

        $longContent = str_repeat('A', $maxLength + 1);

        DocumentModel::create([
            'category_id' => $category->id,
            'title' => 'Título do Documento',
            'contents' => $longContent
        ]);
    }

    /** @test */
    public function testTitleContainsSemesterForRemessa()
    {
        CategoryModel::firstOrCreate(['name' => 'Remessa']);

        // Testa título válido para a categoria "Remessa"
        $this->assertValidTitle('Relatório do primeiro semestre', 'Remessa');

        // Espera um erro quando o título não contém "semestre"
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Registro inválido: título deve conter "semestre" para a categoria Remessa.');
        $this->assertValidTitle('Relatório anual', 'Remessa');
    }

    /** @test */
    public function testTitleContainsMonthForRemessaParcial()
    {
        CategoryModel::firstOrCreate(['name' => 'Remessa Parcial']);

        // Testa título válido para a categoria "Remessa Parcial"
        $this->assertValidTitle('Relatório de Janeiro', 'Remessa Parcial');

        // Espera um erro quando o título não contém um nome de mês
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Registro inválido: título deve conter o nome de um mês para a categoria Remessa Parcial.');
        $this->assertValidTitle('Relatório parcial', 'Remessa Parcial');
    }

    private function assertValidTitle($title, $categoryName)
    {
        if ($categoryName === 'Remessa' && !str_contains(strtolower($title), 'semestre')) {
            throw new \Exception('Registro inválido: título deve conter "semestre" para a categoria Remessa.');
        }

        $months = ['janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'];
        if ($categoryName === 'Remessa Parcial' && !collect($months)->first(fn($month) => str_contains(strtolower($title), $month))) {
            throw new \Exception('Registro inválido: título deve conter o nome de um mês para a categoria Remessa Parcial.');
        }

        $category = CategoryModel::firstOrCreate(['name' => $categoryName]);

        DocumentModel::create([
            'category_id' => $category->id,
            'title' => $title,
            'contents' => 'Conteúdo válido'
        ]);
    }
}
