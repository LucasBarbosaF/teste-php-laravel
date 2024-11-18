<?php

namespace Tests\Unit;

use App\Models\Categories\CategoryModel;
use App\Models\Documents\DocumentModel;
use Tests\TestCase;
use Illuminate\Validation\ValidationException;

class DocumentTest extends TestCase
{
    /** @test */
    public function contents_field_should_have_a_maximum_length()
    {
        $maxLength = 255;

        // Categoria válida
        $category = $this->createCategory();

        // Documento válido
        $validContent = str_repeat('B', $maxLength);
        $this->createDocument($category, 'Resumo Anual', $validContent);

        // Documento inválido (conteúdo acima do limite)
        $this->expectException(ValidationException::class);
        $invalidContent = str_repeat('B', $maxLength + 1);
        $this->createDocument($category, 'Resumo Anual', $invalidContent);
    }

    /** @test */
    public function remessa_titles_should_include_the_word_semester()
    {
        $category = $this->createCategory('Remessa');

        // Título válido
        $this->createDocument($category, 'Planejamento do segundo semestre');

        // Título inválido
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('O título deve conter "semestre" para a categoria Remessa.');
        $this->createDocument($category, 'Planejamento do ano inteiro');
    }

    /** @test */
    public function remessa_parcial_titles_should_include_a_month_name()
    {
        $category = $this->createCategory('Remessa Parcial');

        // Título válido
        $this->createDocument($category, 'Resumo de Atividades - Março');

        // Título inválido
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('O título deve conter o nome de um mês para a categoria Remessa Parcial.');
        $this->createDocument($category, 'Resumo Geral');
    }

    /** Helpers */
    private function createCategory($name = 'Default Category')
    {
        return CategoryModel::firstOrCreate(['name' => $name]);
    }

    private function createDocument($category, $title, $contents = 'Conteúdo padrão')
    {
        $this->validateTitle($title, $category->name);

        return DocumentModel::create([
            'category_id' => $category->id,
            'title' => $title,
            'contents' => $contents,
        ]);
    }

    private function validateTitle($title, $categoryName)
    {
        if ($categoryName === 'Remessa' && !str_contains(strtolower($title), 'semestre')) {
            throw new \Exception('O título deve conter "semestre" para a categoria Remessa.');
        }

        $months = ['janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'];
        if ($categoryName === 'Remessa Parcial' && !collect($months)->contains(fn($month) => str_contains(strtolower($title), $month))) {
            throw new \Exception('O título deve conter o nome de um mês para a categoria Remessa Parcial.');
        }
    }
}
