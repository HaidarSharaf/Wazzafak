<?php

namespace App\Livewire;

use App\Services\AIService;
use App\Traits\Notifications;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Smalot\PdfParser\Parser;

#[Title('AI CV Analyzer | Wazzafak')]
class AiCvAnalyzer extends Component
{
    use WithFileUploads;
    use Notifications;

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
            $this->notify(
                variant: 'danger',
                title: 'Analysis failed',
                message: $e->getMessage()
            );
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

    protected function extractFromWord(string $filePath, string $extension): string
    {
        if ($extension === 'docx') {
            return $this->extractFromDocx($filePath);
        }
        
        if ($extension === 'doc') {
            return $this->extractFromDoc($filePath);
        }
        
        throw new \Exception('Unsupported Word document format');
    }

    protected function extractFromDocx(string $filePath): string
    {
        $zip = new \ZipArchive();
        
        if ($zip->open($filePath) !== true) {
            throw new \Exception('Unable to open DOCX file');
        }
        
        $content = $zip->getFromName('word/document.xml');
        $zip->close();
        
        if ($content === false) {
            throw new \Exception('Unable to extract content from DOCX file');
        }
        
        $text = strip_tags($content);
        $text = html_entity_decode($text, ENT_QUOTES | ENT_XML1, 'UTF-8');
        
        return trim($text);
    }

    protected function extractFromDoc(string $filePath): string
    {
        // Basic extraction for older .doc files
        $content = file_get_contents($filePath);
        
        if ($content === false) {
            throw new \Exception('Unable to read DOC file');
        }
        
        // Extract readable text from binary content
        $content = str_replace(["\r", "\n"], " ", $content);
        $content = preg_replace('/[^\x20-\x7E]/', ' ', $content);
        $content = preg_replace('/\s+/', ' ', $content);
        $text = trim($content);
        
        if (strlen($text) < 50) {
            throw new \Exception('Unable to extract meaningful text from DOC file. Please convert to DOCX or PDF.');
        }
        
        return $text;
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
