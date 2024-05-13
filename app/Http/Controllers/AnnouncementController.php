<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AnnouncementService;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    protected $announcementService;

    public function __construct(AnnouncementService $announcementService)
    {
        $this->announcementService = $announcementService;
    }

    public function index()
    {
        return response()->json($this->announcementService->getAllActiveAnnouncements());
    }

    public function show(Announcement $announcement)
    {
        return response()->json($announcement);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
        ]);

        $announcement = $this->announcementService->createAnnouncement($data);

        return response()->json($announcement, 201);
    }

    public function update(Request $request, Announcement $announcement)
    {
        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'startDate' => 'sometimes|date',
            'endDate' => 'sometimes|date',
            'active' => 'sometimes|boolean'
        ]);

        $updatedAnnouncement = $this->announcementService->updateAnnouncement($announcement, $data);

        return response()->json($updatedAnnouncement);
    }

    public function destroy(Announcement $announcement)
    {
        $this->announcementService->deleteAnnouncement($announcement);

        return response()->json(['message' => 'Announcement deleted successfully']);
    }
}
