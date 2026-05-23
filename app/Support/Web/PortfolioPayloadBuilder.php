<?php

namespace App\Support\Web;

use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Tech;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PortfolioPayloadBuilder
{
    public function build(): array
    {
        $experiences = Experience::query()
            ->orderBy('sort_order')
            ->get();

        $projects = Project::query()
            ->with(['partner', 'collaborators'])
            ->orderBy('sort_order')
            ->get();

        $skills = Skill::query()
            ->orderBy('sort_order')
            ->get();

        $techs = Tech::query()
            ->orderBy('sort_order')
            ->get();

        $settings = $this->loadSettings();
        $yearsActive = $this->deriveYearsActive($experiences);
        $projectCount = $projects->count();
        $skillCount = $skills->count();
        $techCount = $techs->count();

        return [
            'branding' => [
                'siteName' => $settings['site_name'] ?? 'Kariem Ibrahiem',
                'logoUrl' => $this->assetUrl($settings['logo'] ?? 'web/img/logo-s.png'),
                'mark' => 'KB',
            ],
            'profile' => [
                'name' => $settings['profile_name'] ?? 'Kariem Ibrahiem',
                'role' => $settings['profile_role'] ?? 'Laravel Backend Developer',
                'tagline' => $settings['profile_tagline'] ?? 'Backend systems engineered for scale, clarity, and production pressure.',
                'bio' => $settings['profile_bio'] ?? 'I build Laravel platforms that stay stable when the product grows: REST APIs, admin dashboards, payment gateways, ERP and LMS flows, and the service-layer architecture behind them.',
                'avatarUrl' => $this->assetUrl($settings['profile_avatar'] ?? 'web/img/main.jpg'),
                'location' => $settings['profile_location'] ?? 'Egypt',
                'availability' => $settings['profile_availability'] ?? 'Available for freelance backend work and full-time opportunities.',
            ],
            'hero' => [
                'eyebrow' => $settings['hero_eyebrow'] ?? 'SYSTEMS ONLINE',
                'title' => $settings['hero_title'] ?? 'Laravel Backend Developer',
                'subtitle' => $settings['hero_subtitle'] ?? 'REST APIs, admin dashboards, payment integrations, ERP/LMS/marketplace systems, and secure backend architecture built to hold in production.',
                'description' => $settings['hero_description'] ?? 'From database design to deployment pipelines, I focus on stable service layers, clean integrations, and maintainable systems that teams can keep shipping on.',
                'primaryCta' => [
                    'label' => $settings['hero_primary_cta_label'] ?? 'View Projects',
                    'href' => '#projects',
                ],
                'secondaryCta' => [
                    'label' => $settings['hero_secondary_cta_label'] ?? 'Contact Me',
                    'href' => '#contact',
                ],
                'terminalLabels' => [
                    'BACKEND CORE',
                    'API LAYER',
                    'SYSTEM ARCHITECTURE',
                ],
            ],
            'stats' => [
                [
                    'label' => 'Years Active',
                    'value' => (string) $yearsActive,
                    'suffix' => '+',
                ],
                [
                    'label' => 'Projects Delivered',
                    'value' => (string) $projectCount,
                    'suffix' => '+',
                ],
                [
                    'label' => 'Backend Capabilities',
                    'value' => (string) $techCount,
                    'suffix' => '',
                ],
                [
                    'label' => 'Core Skills',
                    'value' => (string) $skillCount,
                    'suffix' => '',
                ],
            ],
            'about' => [
                'eyebrow' => 'BACKEND CORE',
                'title' => 'Clean systems beat clever shortcuts.',
                'description' => $settings['about_description'] ?? 'My backend work starts with clear boundaries: domain rules, service classes, stable queries, authenticated APIs, and production-aware decisions. I care about reliability as much as feature delivery.',
                'highlights' => [
                    'Service-layer architecture',
                    'REST API design',
                    'Database optimization',
                    'Payments and third-party integrations',
                    'Auth, permissions, and production maintenance',
                ],
            ],
            'process' => [
                [
                    'phase' => '01',
                    'title' => 'Discovery',
                    'description' => 'Map the business flow, user roles, edge cases, and operational risks before code starts.',
                ],
                [
                    'phase' => '02',
                    'title' => 'Database & Architecture',
                    'description' => 'Design entities, service boundaries, permissions, and data access patterns that can scale cleanly.',
                ],
                [
                    'phase' => '03',
                    'title' => 'API & Dashboard Development',
                    'description' => 'Build Laravel APIs and admin workflows that stay predictable for both operators and consumers.',
                ],
                [
                    'phase' => '04',
                    'title' => 'Integrations & Testing',
                    'description' => 'Connect payment gateways, external services, notifications, and validation layers with care.',
                ],
                [
                    'phase' => '05',
                    'title' => 'Deployment & Maintenance',
                    'description' => 'Ship to production, monitor behavior, handle fixes fast, and keep the system stable under change.',
                ],
            ],
            'experiences' => $experiences->map(function (Experience $experience) {
                return [
                    'id' => $experience->id,
                    'title' => $experience->title,
                    'company' => $experience->company,
                    'description' => $experience->description,
                    'startDate' => $experience->start_date,
                    'endDate' => $experience->end_date,
                    'iconClass' => $experience->icon_class,
                    'borderColor' => $experience->border_color,
                    'sortOrder' => $experience->sort_order,
                ];
            })->values()->all(),
            'projects' => $projects->values()->map(function (Project $project, int $index) {
                return [
                    'id' => $project->id,
                    'title' => $project->title,
                    'category' => $project->category,
                    'description' => $project->description,
                    'shortDescription' => $this->limitText($project->description, 120),
                    'imageUrl' => $this->assetUrl($project->image),
                    'externalUrl' => $project->url,
                    'featured' => $index < 2,
                    'sortOrder' => $project->sort_order,
                    'badges' => array_values(array_filter([
                        strtoupper((string) $project->category),
                        $project->partner?->name,
                        $project->collaborators->count() ? $project->collaborators->count() . ' collaborators' : null,
                    ])),
                    'partner' => $project->partner ? [
                        'id' => $project->partner->id,
                        'name' => $project->partner->name,
                        'imageUrl' => $this->assetUrl($project->partner->image),
                    ] : null,
                    'collaborators' => $project->collaborators->map(function ($collaborator) {
                        return [
                            'id' => $collaborator->id,
                            'name' => $collaborator->name,
                            'imageUrl' => $this->assetUrl($collaborator->image),
                        ];
                    })->values()->all(),
                ];
            })->all(),
            'skills' => $skills->map(function (Skill $skill) {
                return [
                    'id' => $skill->id,
                    'name' => $skill->name,
                    'iconType' => $skill->icon_type,
                    'iconValue' => $skill->icon_value,
                    'iconUrl' => $skill->icon_type === 'image' ? $this->assetUrl($skill->icon_value) : null,
                    'sortOrder' => $skill->sort_order,
                ];
            })->values()->all(),
            'techs' => $techs->map(function (Tech $tech) {
                return [
                    'id' => $tech->id,
                    'title' => $tech->title,
                    'description' => $tech->description,
                    'sortOrder' => $tech->sort_order,
                ];
            })->values()->all(),
            'contact' => [
                'eyebrow' => 'CONTACT',
                'title' => $settings['contact_title'] ?? "Let's build something that holds.",
                'description' => $settings['contact_description'] ?? 'Open to backend contracts, product partnerships, and long-term engineering roles where reliability matters.',
                'email' => $settings['contact_email'] ?? 'kariemibrahiem110@gmail.com',
                'phone' => $settings['contact_phone'] ?? '+20 01282119707',
                'location' => $settings['contact_location'] ?? 'Egypt',
                'availability' => $settings['contact_availability'] ?? 'Available for freelance backend projects and production support.',
                'primaryCta' => [
                    'label' => 'Start a Conversation',
                    'href' => 'mailto:' . ($settings['contact_email'] ?? 'kariemibrahiem110@gmail.com'),
                ],
            ],
            'socials' => [
                [
                    'label' => 'GitHub',
                    'url' => $settings['social_github'] ?? 'https://github.com/kariemibrahiem',
                    'meta' => 'Source & projects',
                    'abbr' => 'GH',
                ],
                [
                    'label' => 'LinkedIn',
                    'url' => $settings['social_linkedin'] ?? 'https://www.linkedin.com/in/kariem-ibrahiem-903a0b2a7/',
                    'meta' => 'Professional network',
                    'abbr' => 'LI',
                ],
                [
                    'label' => 'Email',
                    'url' => 'mailto:' . ($settings['contact_email'] ?? 'kariemibrahiem110@gmail.com'),
                    'meta' => $settings['contact_email'] ?? 'kariemibrahiem110@gmail.com',
                    'abbr' => 'EM',
                ],
            ],
        ];
    }

    protected function loadSettings(): array
    {
        if (!Schema::hasTable('settings')) {
            return [];
        }

        if (!Schema::hasColumns('settings', ['key', 'value'])) {
            return [];
        }

        return DB::table('settings')
            ->whereNotNull('key')
            ->pluck('value', 'key')
            ->toArray();
    }

    protected function deriveYearsActive(Collection $experiences): int
    {
        $years = $experiences
            ->map(fn (Experience $experience) => $this->extractYear($experience->start_date))
            ->filter()
            ->values();

        if ($years->isEmpty()) {
            return max(1, $experiences->count());
        }

        return max(1, now()->year - $years->min() + 1);
    }

    protected function extractYear(?string $value): ?int
    {
        if (!$value) {
            return null;
        }

        if (preg_match('/(19|20)\d{2}/', $value, $matches)) {
            return (int) $matches[0];
        }

        try {
            return Carbon::parse($value)->year;
        } catch (\Throwable) {
            return null;
        }
    }

    protected function assetUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return asset(ltrim($path, '/'));
    }

    protected function limitText(?string $text, int $length): string
    {
        $text = trim(strip_tags((string) $text));

        if (mb_strlen($text) <= $length) {
            return $text;
        }

        return rtrim(mb_substr($text, 0, $length - 1)) . '…';
    }
}
