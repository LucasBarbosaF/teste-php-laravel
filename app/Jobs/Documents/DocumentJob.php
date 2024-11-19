<?php

namespace App\Jobs\Documents;

use App\Exceptions\DocumentException;
use App\Models\Categories\CategoryModel;
use App\Models\Documents\DocumentModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class DocumentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $document;

    /**
     * Create a new job instance.
     */
    public function __construct($document)
    {
        $this->document = $document;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $category = CategoryModel::where('name', $this->document->categoria)->firstOrFail();
        DocumentModel::create([
            'title' => $this->document->titulo,
            'contents' => $this->document->conteúdo,
            'category_id' => $category->id
        ]);
        Log::info("Job Processado com sucesso");
    }

    public function failed(DocumentException $exception)
    {
        Log::error("Job falhou com a seguinte exceção: {$exception->getMessage()}");
    }
}
