<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaffMember;
use App\Models\CustomerUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    use AuthorizesAdmin;
    
    public function index(Request $request): View
    {
        $this->authorizeAdmin($request);

        $view = $request->get('view', 'staff');

        // Get staff from StaffMember model
        $staff = StaffMember::orderByDesc('created_at')->get();

        // Get customers from CustomerUser model
        $customers = CustomerUser::orderByDesc('created_at')->get();

        return view('admin.users', [
            'staff' => $staff,
            'customers' => $customers,
            'view' => $view === 'customers' ? 'customers' : 'staff',
        ]);
    }

    public function show(Request $request, $id): View
    {
        $this->authorizeAdmin($request);

        // Try to find as StaffMember first, then CustomerUser
        $user = StaffMember::find($id) ?? CustomerUser::find($id);

        if (!$user) {
            abort(404, 'User not found');
        }

        return view('admin.user_profile', compact('user'));
    }

    public function updateStatus(Request $request, $id): RedirectResponse
    {
        $this->authorizeAdmin($request);

        $data = $request->validate([
            'status' => 'required|in:active,pending,rejected',
        ]);

        // Try to find as StaffMember first, then CustomerUser
        $user = StaffMember::find($id) ?? CustomerUser::find($id);

        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        $user->update(['status' => $data['status']]);

        return back()->with('success', 'User status updated.');
    }

    public function destroy(Request $request, $id): RedirectResponse
    {
        $this->authorizeAdmin($request);

        // Try to find as StaffMember first, then CustomerUser
        $user = StaffMember::find($id) ?? CustomerUser::find($id);

        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        // Prevent self-deletion for safety
        if ($request->user()->id === $user->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return back()->with('success', 'User removed.');
    }

}

