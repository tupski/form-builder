<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\FormSubmission;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_forms' => Form::count(),
            'active_forms' => Form::where('is_active', true)->count(),
            'total_submissions' => FormSubmission::count(),
            'submissions_today' => FormSubmission::whereDate('created_at', today())->count(),
            'submissions_this_week' => FormSubmission::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
        ];

        $recent_forms = Form::with('user')->latest()->take(5)->get();
        $recent_submissions = FormSubmission::with('form')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_forms', 'recent_submissions'));
    }
}
