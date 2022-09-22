<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();

        if($user->is_admin){
            return redirect()->route('admin.users.index');
        }

        return Inertia::render('Dashboard', [
            'tokens' => $request->user()->Tokens()->paginate()
        ]);
    }
}
