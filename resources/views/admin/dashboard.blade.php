@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <!-- Info boxes -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Users</span>
                    <span class="info-box-number">{{ number_format($stats['total_users']) }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-wpforms"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Forms</span>
                    <span class="info-box-number">{{ number_format($stats['total_forms']) }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Active Forms</span>
                    <span class="info-box-number">{{ number_format($stats['active_forms']) }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-paper-plane"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Submissions</span>
                    <span class="info-box-number">{{ number_format($stats['total_submissions']) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Submission Stats -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Submission Statistics</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> {{ $stats['submissions_today'] }}</span>
                                <h5 class="description-header">{{ number_format($stats['submissions_today']) }}</h5>
                                <span class="description-text">TODAY</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="description-block">
                                <span class="description-percentage text-info"><i class="fas fa-caret-up"></i> {{ $stats['submissions_this_week'] }}</span>
                                <h5 class="description-header">{{ number_format($stats['submissions_this_week']) }}</h5>
                                <span class="description-text">THIS WEEK</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Quick Actions</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('forms.create') }}" class="btn btn-primary btn-block">
                                <i class="fas fa-plus"></i> Create Form
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-info btn-block">
                                <i class="fas fa-users"></i> Manage Users
                            </a>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <a href="{{ route('admin.forms.index') }}" class="btn btn-success btn-block">
                                <i class="fas fa-wpforms"></i> All Forms
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.translations.index') }}" class="btn btn-warning btn-block">
                                <i class="fas fa-language"></i> Translations
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Forms</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.forms.index') }}" class="btn btn-tool">
                            <i class="fas fa-eye"></i> View All
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @forelse($recent_forms as $form)
                            <li class="item">
                                <div class="product-img">
                                    <span class="badge {{ $form->is_active ? 'badge-success' : 'badge-secondary' }}">
                                        {{ $form->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                                <div class="product-info">
                                    <a href="{{ route('forms.builder', $form) }}" class="product-title">
                                        {{ $form->title }}
                                        <span class="badge badge-info float-right">{{ $form->fields->count() }} fields</span>
                                    </a>
                                    <span class="product-description">
                                        by {{ $form->user->name }} • {{ $form->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </li>
                        @empty
                            <li class="item">
                                <div class="product-info">
                                    <span class="product-description text-muted">No forms created yet.</span>
                                </div>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Submissions</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.submissions.index') }}" class="btn btn-tool">
                            <i class="fas fa-eye"></i> View All
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @forelse($recent_submissions as $submission)
                            <li class="item">
                                <div class="product-img">
                                    <i class="fas fa-paper-plane text-primary"></i>
                                </div>
                                <div class="product-info">
                                    <a href="{{ route('forms.submissions', $submission->form) }}" class="product-title">
                                        {{ $submission->form->title }}
                                        <span class="badge badge-primary float-right">#{{ $submission->id }}</span>
                                    </a>
                                    <span class="product-description">
                                        {{ $submission->created_at->diffForHumans() }} • IP: {{ $submission->ip_address ?? 'Unknown' }}
                                    </span>
                                </div>
                            </li>
                        @empty
                            <li class="item">
                                <div class="product-info">
                                    <span class="product-description text-muted">No submissions yet.</span>
                                </div>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Auto refresh stats every 30 seconds
    setInterval(function() {
        // You can add AJAX call here to refresh stats
    }, 30000);
</script>
@endpush
