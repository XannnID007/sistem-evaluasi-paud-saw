<style>
    /* Custom Pagination Styles */
    .pagination-wrapper {
        background: white;
        border-top: 1px solid #e5e7eb;
    }

    .pagination-info {
        color: #6b7280;
        font-size: 0.875rem;
    }

    .pagination-nav a,
    .pagination-nav span {
        transition: all 0.2s ease-in-out;
    }

    .pagination-nav a:hover {
        background-color: #f3f4f6;
        border-color: #d1d5db;
    }

    .pagination-nav .current-page {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        border-color: #3b82f6;
    }

    .pagination-nav .disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* Per Page Selector Styles */
    .per-page-selector select {
        border-radius: 0.375rem;
        border: 1px solid #d1d5db;
        padding: 0.25rem 0.75rem;
        font-size: 0.875rem;
        transition: all 0.2s ease-in-out;
    }

    .per-page-selector select:focus {
        outline: none;
        ring: 2px;
        ring-color: #3b82f6;
        border-color: #3b82f6;
    }

    /* Sortable Header Styles */
    .sortable-header {
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }

    .sortable-header:hover {
        background-color: #f9fafb;
    }

    .sortable-header.active {
        background-color: #eff6ff;
    }

    .sortable-header .sort-icon {
        opacity: 0.6;
        transition: all 0.2s ease-in-out;
    }

    .sortable-header:hover .sort-icon {
        opacity: 1;
    }

    .sortable-header.active .sort-icon {
        opacity: 1;
        color: #3b82f6;
    }

    /* Loading Animation for Tables */
    .table-loading {
        position: relative;
    }

    .table-loading::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
    }

    /* Search and Filter Form Styles */
    .search-filter-form {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border: 1px solid #e2e8f0;
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .search-filter-form input,
    .search-filter-form select {
        transition: all 0.2s ease-in-out;
    }

    .search-filter-form input:focus,
    .search-filter-form select:focus {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
    }

    /* Mobile Responsive Pagination */
    @media (max-width: 640px) {
        .pagination-wrapper {
            padding: 0.75rem;
        }

        .pagination-nav {
            justify-content: center;
        }

        .pagination-info {
            text-align: center;
            margin-bottom: 0.75rem;
        }

        .per-page-selector {
            font-size: 0.75rem;
        }
    }

    /* Empty State Animations */
    .empty-state {
        animation: fadeInUp 0.6s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Table Row Hover Effects */
    .table-row-hover {
        transition: all 0.2s ease-in-out;
    }

    .table-row-hover:hover {
        background-color: #f8fafc;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Badge Hover Effects */
    .badge-hover {
        transition: all 0.2s ease-in-out;
    }

    .badge-hover:hover {
        transform: scale(1.05);
    }

    /* Action Button Group */
    .action-group {
        display: flex;
        gap: 0.25rem;
    }

    .action-group button,
    .action-group a {
        transition: all 0.2s ease-in-out;
    }

    .action-group button:hover,
    .action-group a:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }
</style>
