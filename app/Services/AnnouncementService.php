<?php

namespace App\Services;

use App\Models\Announcement;
use Carbon\Carbon;

class AnnouncementService
{
    public function getAllActiveAnnouncements()
    {
        return Announcement::where('active', true)
            // ->where('startDate', '<=', Carbon::now())
            // ->where('endDate', '>=', Carbon::now())
            ->orderBy('startDate', 'desc')
            ->get();
    }

    public function createAnnouncement($data)
    {
        $data['active'] = $this->isActive($data['startDate'], $data['endDate']);
        return Announcement::create($data);
    }

    public function updateAnnouncement(Announcement $announcement, $data)
    {
        $data['active'] = $this->isActive($data['startDate'], $data['endDate']);
        $announcement->update($data);
        return $announcement;
    }

    public function deleteAnnouncement(Announcement $announcement)
    {
        $announcement->delete();
    }

    private function isActive($startDate, $endDate)
    {
        $now = Carbon::now();
        return $now->between($startDate, $endDate);
    }
}
