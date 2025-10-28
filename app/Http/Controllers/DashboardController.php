<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Invoices\Models\Invoice;
use Modules\Quotes\Models\Quote;
use Modules\Projects\Models\Project;
use Modules\Projects\Models\Task;
use Modules\Core\Models\Setting;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with overview data.
     */
    public function index(): View
    {
        // Get invoice overview period setting
        $invoiceOverviewPeriod = Setting::where('setting_key', 'invoice_overview_period')
            ->first()?->setting_value ?? 'all-time';
        
        // Get quote overview period setting
        $quoteOverviewPeriod = Setting::where('setting_key', 'quote_overview_period')
            ->first()?->setting_value ?? 'all-time';

        // Get invoice status totals
        $invoiceStatusTotals = $this->getInvoiceStatusTotals();
        
        // Get quote status totals
        $quoteStatusTotals = $this->getQuoteStatusTotals();
        
        // Get recent invoices (limited to 10)
        $invoices = Invoice::with('client')
            ->latest('invoice_date_created')
            ->limit(10)
            ->get();
        
        // Get recent quotes (limited to 10)
        $quotes = Quote::with('client')
            ->latest('quote_date_created')
            ->limit(10)
            ->get();
        
        // Get overdue invoices
        $overdueInvoices = Invoice::with('client')
            ->where('invoice_status_id', 2)
            ->where('invoice_date_due', '<', now())
            ->get();
        
        // Get latest projects
        $projects = Project::with('client')
            ->latest('created_at')
            ->limit(5)
            ->get();
        
        // Get latest tasks
        $tasks = Task::with('project')
            ->latest('created_at')
            ->limit(10)
            ->get();
        
        // Define invoice statuses
        $invoiceStatuses = [
            1 => ['label' => 'Draft', 'class' => 'label-default'],
            2 => ['label' => 'Sent', 'class' => 'label-info'],
            3 => ['label' => 'Viewed', 'class' => 'label-primary'],
            4 => ['label' => 'Paid', 'class' => 'label-success'],
        ];
        
        // Define quote statuses
        $quoteStatuses = [
            1 => ['label' => 'Draft', 'class' => 'label-default'],
            2 => ['label' => 'Sent', 'class' => 'label-info'],
            3 => ['label' => 'Approved', 'class' => 'label-success'],
            4 => ['label' => 'Rejected', 'class' => 'label-danger'],
        ];
        
        // Define task statuses
        $taskStatuses = [
            'pending' => ['label' => 'Pending', 'class' => 'label-warning'],
            'in_progress' => ['label' => 'In Progress', 'class' => 'label-info'],
            'completed' => ['label' => 'Completed', 'class' => 'label-success'],
        ];

        return view('dashboard.index', [
            'invoice_status_totals' => $invoiceStatusTotals,
            'quote_status_totals' => $quoteStatusTotals,
            'invoices' => $invoices,
            'quotes' => $quotes,
            'overdue_invoices' => $overdueInvoices,
            'projects' => $projects,
            'tasks' => $tasks,
            'invoice_statuses' => $invoiceStatuses,
            'quote_statuses' => $quoteStatuses,
            'task_statuses' => $taskStatuses,
            'invoice_status_period' => str_replace('-', '_', $invoiceOverviewPeriod),
            'quote_status_period' => str_replace('-', '_', $quoteOverviewPeriod),
        ]);
    }

    /**
     * Get invoice status totals.
     */
    private function getInvoiceStatusTotals(): array
    {
        $totals = [];
        
        for ($statusId = 1; $statusId <= 4; $statusId++) {
            $count = Invoice::where('invoice_status_id', $statusId)->count();
            $sumTotal = Invoice::where('invoice_status_id', $statusId)->sum('invoice_total');
            
            $totals[] = [
                'status_id' => $statusId,
                'label' => $this->getInvoiceStatusLabel($statusId),
                'count' => $count,
                'sum_total' => $sumTotal,
                'href' => "invoices/status/{$statusId}",
                'class' => $this->getInvoiceStatusClass($statusId),
            ];
        }
        
        return $totals;
    }

    /**
     * Get quote status totals.
     */
    private function getQuoteStatusTotals(): array
    {
        $totals = [];
        
        for ($statusId = 1; $statusId <= 4; $statusId++) {
            $count = Quote::where('quote_status_id', $statusId)->count();
            $sumTotal = Quote::where('quote_status_id', $statusId)->sum('quote_total');
            
            $totals[] = [
                'status_id' => $statusId,
                'label' => $this->getQuoteStatusLabel($statusId),
                'count' => $count,
                'sum_total' => $sumTotal,
                'href' => "quotes/status/{$statusId}",
                'class' => $this->getQuoteStatusClass($statusId),
            ];
        }
        
        return $totals;
    }

    private function getInvoiceStatusLabel(int $statusId): string
    {
        return match($statusId) {
            1 => 'Draft',
            2 => 'Sent',
            3 => 'Viewed',
            4 => 'Paid',
            default => 'Unknown',
        };
    }

    private function getQuoteStatusLabel(int $statusId): string
    {
        return match($statusId) {
            1 => 'Draft',
            2 => 'Sent',
            3 => 'Approved',
            4 => 'Rejected',
            default => 'Unknown',
        };
    }

    private function getInvoiceStatusClass(int $statusId): string
    {
        return match($statusId) {
            1 => 'label-default',
            2 => 'label-info',
            3 => 'label-primary',
            4 => 'label-success',
            default => '',
        };
    }

    private function getQuoteStatusClass(int $statusId): string
    {
        return match($statusId) {
            1 => 'label-default',
            2 => 'label-info',
            3 => 'label-success',
            4 => 'label-danger',
            default => '',
        };
    }
}
