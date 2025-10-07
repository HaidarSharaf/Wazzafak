<?php

namespace App\Livewire;

use App\Services\AIService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Smalot\PdfParser\Parser;

#[Title('AI CV Analyzer | Wazzafak')]
class AiCvAnalyzer extends Component
{
    use WithFileUploads;

    #[Validate('required|file|mimes:pdf,doc,docx|max:5120')]
    public $cv;
    public $analysisResult = [];
    public $analyzed = false;
    public $errorMessage = '';

    public function analyzeCV()
    {
        $this->validate();
        $this->errorMessage = '';
        $this->analyzed = false;

        try {
            $text = $this->extractText($this->cv);

            if (!$this->isLikelyCV($text)) {
                $this->errorMessage = 'This document does not appear to be a CV or resume. Please upload a valid CV.';
                return;
            }

            $aiService = new AIService();
            $rawResponse = $aiService->analyzeCV($text);

            $rawResponse = preg_replace('/```json\s*|\s*```/', '', $rawResponse);
            $rawResponse = trim($rawResponse);

            $decoded = json_decode($rawResponse, true);

            $requiredKeys = ['rating', 'strengths', 'weaknesses', 'improvements'];
            foreach ($requiredKeys as $key) {
                if (!isset($decoded[$key])) {
                    throw new \Exception("Missing required key: {$key}");
                }
            }

            $decoded['strengths'] = (array) ($decoded['strengths'] ?? []);
            $decoded['weaknesses'] = (array) ($decoded['weaknesses'] ?? []);
            $decoded['improvements'] = (array) ($decoded['improvements'] ?? []);

            $this->analysisResult = $decoded;
            $this->analyzed = true;

        } catch (\Exception $e) {
            $this->errorMessage = 'Analysis failed: ' . $e->getMessage();
            logger()->error('CV Analysis Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    protected function extractText($file): string
    {
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();

        if ($extension === 'pdf') {
            $parser = new Parser();
            $pdf = $parser->parseFile($tempPath);
            return $pdf->getText();
        }

        if (in_array($extension, ['doc', 'docx'])) {
            return $this->extractFromWord($tempPath, $extension);
        }

        throw new \Exception('Unsupported file type');
    }

    public function resetResponse()
    {
        $this->reset(['cv', 'analysisResult', 'analyzed', 'errorMessage']);
    }

    protected function isLikelyCV(string $text): bool
    {
        $text = strtolower($text);

        $cvKeywords = [
            'experience', 'education', 'skills', 'work history',
            'employment', 'qualification', 'resume', 'cv',
            'objective', 'summary', 'professional', 'career',
            'bachelor', 'master', 'degree', 'university',
            'project', 'responsibilities', 'achievements'
        ];

        $matchCount = 0;

        foreach ($cvKeywords as $keyword) {
            if (strpos($text, $keyword) !== false) {
                $matchCount++;
            }
        }

        return $matchCount >= 3;
    }

    public function render()
    {
        return view('livewire.ai-cv-analyzer');
    }
}
