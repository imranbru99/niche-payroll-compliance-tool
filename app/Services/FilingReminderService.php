<?php

namespace App\Services;

use App\Models\ComplianceAlert;
use App\Models\ComplianceFiling;
use Illuminate\Support\Collection;

class FilingReminderService
{
    public function openLateFilings(): Collection
    {
        return ComplianceFiling::query()
            ->whereIn('status', ['draft', 'in_progress', 'submitted'])
            ->whereDate('due_on', '<', now()->toDateString())
            ->orderBy('due_on')
            ->get();
    }

    public function syncLateAlerts(): int
    {
        $created = 0;

        foreach ($this->openLateFilings() as $filing) {
            $alert = ComplianceAlert::query()->firstOrCreate(
                [
                    'source_type' => ComplianceFiling::class,
                    'source_id' => $filing->id,
                    'alert_type' => 'late_filing',
                ],
                [
                    'jurisdiction_id' => $filing->jurisdiction_id,
                    'severity' => 'high',
                    'title' => "Late filing: {$filing->reference}",
                    'message' => "Filing {$filing->title} was due on {$filing->due_on->toDateString()}.",
                    'status' => 'open',
                    'detected_at' => now(),
                ]
            );

            if ($alert->wasRecentlyCreated) {
                $created++;
            }
        }

        return $created;
    }
}
