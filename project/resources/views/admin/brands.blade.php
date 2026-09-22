@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Hardware Brands</h1>
        <div class="page-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a> &bull; <span>Partner Brands</span>
        </div>
    </div>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-hoc align-middle mb-0">
            <thead>
                <tr>
                    <th>Brand Name</th>
                    <th>Active Products</th>
                    <th>Status</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody id="brands-table-body">
                <!-- Populated via JS -->
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const tbody = document.getElementById("brands-table-body");
        const brands = DataStore.get().brands || [];

        let html = "";
        brands.forEach(b => {
            html += `
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-light rounded p-2 text-center" style="width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-award text-primary fs-4"></i>
                            </div>
                            <strong>${b.name}</strong>
                        </div>
                    </td>
                    <td><span class="badge bg-light text-dark border">${b.count} Products</span></td>
                    <td><span class="badge badge-soft-success">Active</span></td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-outline-primary me-1" onclick="alert('Edit brand: ${b.name}')"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-sm btn-outline-danger" onclick="alert('Delete brand')"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
            `;
        });
        tbody.innerHTML = html;
    });
</script>
@endpush
