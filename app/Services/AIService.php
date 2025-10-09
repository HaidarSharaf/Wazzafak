<?php

namespace App\Services;

use OpenAI;

class AIService
{
    protected $client;

    public function __construct()
    {
        $this->client = OpenAI::factory()
            ->withBaseUri('https://api.groq.com/openai/v1')
            ->withHttpHeader('Authorization', 'Bearer ' . config('services.groq.api_key'))
            ->make();
    }

    public function analyzeCV(string $cvText): string
    {
        $response = $this->client->chat()->create([
            'model' => 'llama-3.3-70b-versatile',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a CV analysis expert. Analyze resumes and ALWAYS return a valid JSON object with keys: rating (0-10), strengths (array), weaknesses (array), improvements (array). No extra text.'
                ],
                [
                    'role' => 'user',
                    'content' => $cvText
                ],
            ],
        ]);

        return $response->choices[0]->message->content;
    }

    public function generateJobDescription(array $job_details): string
    {
        $stack_name = $job_details['stack_name'];
        $experience = $job_details['experience'];
        $location = $job_details['location'];
        $salary = $job_details['salary'];
        $technologies = $job_details['technologies'];

        $techList = implode(', ', $technologies);

        $prompt = "Create a concise and professional job description for a {$stack_name} position with the following details:

                        Experience Level: {$experience}
                        Location: {$location}
                        Salary: \${$salary}
                        Required Technologies: {$techList}

                        IMPORTANT GUIDELINES:
                        - Keep it SHORT and to the point (maximum 250-300 words)
                        - DO NOT include application instructions or 'how to apply' section
                        - DO NOT ask for CV, resume, portfolio, or any documents (applicants submit these automatically through our platform)
                        - DO NOT include contact information or email addresses
                        - DO NOT use bullet points
                        - Focus ONLY on the role itself

                        The description should include:
                        1. A brief overview of the role (2-3 sentences)
                        2. Key responsibilities
                        3. Required skills and qualifications
                        4. Optional: 1-2 nice-to-have skills

                        Use a professional but friendly tone. Be direct and clear.
                    ";

        $response = $this->client->chat()->create([
            'model' => 'llama-3.3-70b-versatile',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are an expert HR professional. Create SHORT, concise job descriptions (250-300 words max). Never include application instructions, as our platform handles that automatically. Focus only on the role, responsibilities, and requirements.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ],
            ],
            'temperature' => 0.7,
            'max_tokens' => 500,
        ]);

        return $response->choices[0]->message->content;
    }

    public function analyzeCVsForJob(array $cvData, array $jobRequirements): array
    {
        $cvList = '';
        foreach ($cvData as $cv) {
            $cvList .= "Name: {$cv['name']}\n";
            $cvList .= "Email: {$cv['email']}\n";
            $cvList .= "Experience Level: {$cv['experience']}\n";
            $cvList .= "Stacks: " . implode(', ', $cv['stacks']) . "\n";
            $cvList .= "Technologies: " . implode(', ', $cv['technologies']) . "\n";
            $cvList .= "CV Content:\n{$cv['cv_text']}\n\n";
            $cvList .= "---\n\n";
        }

        $prompt = "You are an expert HR recruiter. Analyze the following CVs for a job position.

                    Job Requirements:
                    - Stack: {$jobRequirements['stack']}
                    - Experience Level: {$jobRequirements['experience']}
                    - Required Technologies: " . implode(', ', $jobRequirements['technologies']) . "
                    - Salary: \${$jobRequirements['salary']}

                    Applicants:
                    {$cvList}

                    CRITICAL INSTRUCTIONS:
                    1. First, determine if ANY applicant is suitable for this position
                    2. If the job is for a specific field (e.g., Cybersecurity, Backend, Frontend, DevOps) and NO applicant has relevant experience in that field, set \"has_suitable_candidate\" to false
                    3. A Frontend developer is NOT suitable for a Backend/Cybersecurity job and vice versa
                    4. An applicant with completely different tech stack is NOT suitable
                    5. Only recommend someone if they have relevant experience for THIS specific role

                    Return ONLY a valid JSON object with this exact structure:

                    If NO suitable candidates exist:
                    {
                      \"has_suitable_candidate\": false,
                      \"reasoning\": \"Brief explanation why none of the applicants are suitable (2-3 sentences)\",
                      \"mismatches\": [\"mismatch 1\", \"mismatch 2\", \"mismatch 3\"]
                    }

                    If there IS a suitable candidate:
                    {
                      \"has_suitable_candidate\": true,
                      \"best_applicant_name\": \"name of the best candidate\",
                      \"best_applicant_email\": \"email of the best candidate\",
                      \"score\": 85,
                      \"reasoning\": \"Brief explanation (2-3 sentences) why this candidate is the best fit\",
                      \"strengths\": [\"strength 1\", \"strength 2\", \"strength 3\"],
                      \"concerns\": [\"concern 1\", \"concern 2\"] or empty array if none
                    }

                    Be strict and objective. Don't recommend unqualified candidates. No extra text outside the JSON.";

        $response = $this->client->chat()->create([
            'model' => 'llama-3.3-70b-versatile',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are an expert HR recruitment assistant. Be STRICT about candidate-job matching. A Frontend developer is NOT suitable for Backend/Cybersecurity roles. Analyze CVs objectively and return ONLY valid JSON. No markdown, no code blocks, just pure JSON. If no candidate matches the job requirements, say so.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ],
            ],
            'temperature' => 0.3,
            'max_tokens' => 800,
        ]);

        $result = $response->choices[0]->message->content;
        $result = preg_replace('/```json\s*|\s*```/', '', $result);
        $decoded = json_decode(trim($result), true);

        if (!$decoded || !isset($decoded['has_suitable_candidate'])) {
            throw new \Exception('Invalid AI response format');
        }

        return $decoded;
    }

    public function generateCVContent(array $userData): array
    {
        $name = $userData['name'];
        $email = $userData['email'] ?? '';
        $phone = $userData['phone'] ?? '';
        $location = $userData['location'] ?? '';
        $linkedin = $userData['linkedin'] ?? '';
        $github = $userData['github'] ?? '';
        $stacks = implode(', ', $userData['stacks'] ?? []);
        $technologies = implode(', ', $userData['technologies'] ?? []);

        $experiencesText = '';
        if (!empty($userData['experiences'])) {
            foreach ($userData['experiences'] as $exp) {
                $experiencesText .= "- {$exp['title']} at {$exp['company']} ({$exp['duration']})\n";
                $experiencesText .= "  Description: {$exp['description']}\n\n";
            }
        }

        $educationsText = '';
        if (!empty($userData['educations'])) {
            foreach ($userData['educations'] as $edu) {
                $educationsText .= "- {$edu['degree']} from {$edu['institution']} ({$edu['year']})\n\n";
            }
        }

        $certificationsText = '';
        if (!empty($userData['certifications'])) {
            foreach ($userData['certifications'] as $cert) {
                $certificationsText .= "- {$cert['name']} from {$cert['issuer']}\n";
                $certificationsText .= "  {$cert['description']}\n\n";
            }
        }

        $prompt = "You are an expert CV writer. Generate a professional CV summary and project descriptions for a developer.

        Developer Information:
        Name: {$name}
        Email: {$email}
        Phone: {$phone}
        Location: {$location}
        LinkedIn: {$linkedin}
        GitHub: {$github}
        Stacks: {$stacks}
        Technologies: {$technologies}

        Work Experiences:
        {$experiencesText}

        Education:
        {$educationsText}

        Certifications:
        {$certificationsText}

        Generate ONLY a JSON response with:
        {
          \"professional_summary\": \"A compelling 2-3 sentence professional summary highlighting their expertise and strengths\",
          \"project_suggestions\": [
            {
              \"title\": \"Project name\",
              \"description\": \"Brief project description\",
              \"technologies\": \"Technologies used\",
              \"highlights\": [\"achievement 1\", \"achievement 2\", \"achievement 3\"]
            }
          ]
        }

        Make it professional, concise, and impactful. Base the summary on their stacks, technologies, and experience.";

        $response = $this->client->chat()->create([
            'model' => 'llama-3.3-70b-versatile',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a professional CV writer. Generate compelling professional summaries and project descriptions. Return ONLY valid JSON, no markdown, no code blocks.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ],
            ],
            'temperature' => 0.7,
            'max_tokens' => 1000,
        ]);

        $result = $response->choices[0]->message->content;
        $result = preg_replace('/```json\s*|\s*```/', '', $result);
        $decoded = json_decode(trim($result), true);

        if (!$decoded) {
            throw new \Exception('Invalid AI response format');
        }

        return $decoded;
    }

}
