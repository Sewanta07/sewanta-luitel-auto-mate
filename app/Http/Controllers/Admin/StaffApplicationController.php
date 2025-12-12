<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaffMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StaffApplicationController extends Controller
{
    use AuthorizesAdmin;
    public function index(Request $request): View
    {
        $this->authorizeAdmin($request);

        $pendingStaff = StaffMember::where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.staff_applications', compact('pendingStaff'));
    }

    public function approve(Request $request, StaffMember $staff): RedirectResponse
    {
        $this->authorizeAdmin($request);

        $staff->update(['status' => 'active']);

        return back()->with('success', 'Staff application approved.');
    }

    public function reject(Request $request, StaffMember $staff): RedirectResponse
    {
        $this->authorizeAdmin($request);

        $staff->update(['status' => 'rejected']);

        return back()->with('success', 'Staff application rejected.');
    }

    public function updateRole(Request $request, StaffMember $staff): RedirectResponse
    {
        $this->authorizeAdmin($request);

        $data = $request->validate([
            'level' => 'nullable|string|max:100',
        ]);

        $staff->update([
            'position' => $data['level'] ?? $staff->position ?? null
        ]);

        return back()->with('success', 'Staff record updated.');
    }

    public function destroy(Request $request, StaffMember $staff): RedirectResponse
    {
        $this->authorizeAdmin($request);

        $staff->delete();

        return back()->with('success', 'Staff account removed.');
    }

}

