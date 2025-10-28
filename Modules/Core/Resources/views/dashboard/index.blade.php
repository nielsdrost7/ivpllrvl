<x-filament-panels::page>
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- Invoice Overview Widget Placeholder -->
        <div class="filament-widget">
            <x-filament::section>
                <x-slot name="heading">
                    <div class="flex items-center justify-between">
                        <span>{{ __('Invoice Overview') }}</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ __($invoice_status_period) }}
                        </span>
                    </div>
                </x-slot>
                
                <div class="space-y-2">
                    @foreach($invoice_status_totals as $total)
                        <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50 dark:bg-gray-800">
                            <a href="{{ url($total['href']) }}" class="flex-1 hover:underline">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $total['class'] }}">
                                    {{ $total['label'] }}
                                </span>
                            </a>
                            <span class="font-semibold">
                                {{ format_currency($total['sum_total']) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </x-filament::section>
        </div>

        <!-- Quote Overview Widget Placeholder -->
        <div class="filament-widget">
            <x-filament::section>
                <x-slot name="heading">
                    <div class="flex items-center justify-between">
                        <span>{{ __('Quote Overview') }}</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ __($quote_status_period) }}
                        </span>
                    </div>
                </x-slot>
                
                <div class="space-y-2">
                    @foreach($quote_status_totals as $total)
                        <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50 dark:bg-gray-800">
                            <a href="{{ url($total['href']) }}" class="flex-1 hover:underline">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $total['class'] }}">
                                    {{ $total['label'] }}
                                </span>
                            </a>
                            <span class="font-semibold">
                                {{ format_currency($total['sum_total']) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </x-filament::section>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- Recent Invoices -->
        <x-filament::section>
            <x-slot name="heading">
                {{ __('Recent Invoices') }}
            </x-slot>
            
            <div class="space-y-2">
                @forelse($invoices as $invoice)
                    <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50 dark:bg-gray-800">
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $invoice_statuses[$invoice->invoice_status_id]['class'] ?? '' }}">
                                    {{ $invoice_statuses[$invoice->invoice_status_id]['label'] ?? 'Unknown' }}
                                </span>
                                <span class="text-sm">{{ $invoice->invoice_number ?? '#' . $invoice->id }}</span>
                            </div>
                            <div class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ $invoice->client->client_name ?? 'N/A' }}
                            </div>
                        </div>
                        <span class="font-semibold">
                            {{ format_currency($invoice->invoice_balance) }}
                        </span>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('No invoices found') }}</p>
                @endforelse
            </div>
        </x-filament::section>

        <!-- Recent Quotes -->
        <x-filament::section>
            <x-slot name="heading">
                {{ __('Recent Quotes') }}
            </x-slot>
            
            <div class="space-y-2">
                @forelse($quotes as $quote)
                    <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50 dark:bg-gray-800">
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $quote_statuses[$quote->quote_status_id]['class'] ?? '' }}">
                                    {{ $quote_statuses[$quote->quote_status_id]['label'] ?? 'Unknown' }}
                                </span>
                                <span class="text-sm">{{ $quote->quote_number ?? '#' . $quote->id }}</span>
                            </div>
                            <div class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ $quote->client->client_name ?? 'N/A' }}
                            </div>
                        </div>
                        <span class="font-semibold">
                            {{ format_currency($quote->quote_total) }}
                        </span>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('No quotes found') }}</p>
                @endforelse
            </div>
        </x-filament::section>
    </div>

    @if($overdue_invoices->isNotEmpty())
        <div class="mt-6">
            <x-filament::section>
                <x-slot name="heading">
                    <span class="text-danger-600 dark:text-danger-400">{{ __('Overdue Invoices') }}</span>
                </x-slot>
                
                <div class="space-y-2">
                    @foreach($overdue_invoices as $invoice)
                        <div class="flex items-center justify-between p-3 rounded-lg bg-danger-50 dark:bg-danger-900/20">
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-medium">{{ $invoice->invoice_number ?? '#' . $invoice->id }}</span>
                                    <span class="text-xs text-gray-600 dark:text-gray-400">
                                        Due: {{ $invoice->invoice_date_due?->format('M d, Y') }}
                                    </span>
                                </div>
                                <div class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ $invoice->client->client_name ?? 'N/A' }}
                                </div>
                            </div>
                            <span class="font-semibold text-danger-600 dark:text-danger-400">
                                {{ format_currency($invoice->invoice_balance) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </x-filament::section>
        </div>
    @endif

    @if(config('app.projects_enabled', true))
        <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Projects -->
            <x-filament::section>
                <x-slot name="heading">
                    {{ __('Recent Projects') }}
                </x-slot>
                
                <div class="space-y-2">
                    @forelse($projects as $project)
                        <div class="p-3 rounded-lg bg-gray-50 dark:bg-gray-800">
                            <div class="font-medium">{{ $project->project_name }}</div>
                            <div class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ $project->client->client_name ?? 'No client' }}
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('No projects found') }}</p>
                    @endforelse
                </div>
            </x-filament::section>

            <!-- Tasks -->
            <x-filament::section>
                <x-slot name="heading">
                    {{ __('Recent Tasks') }}
                </x-slot>
                
                <div class="space-y-2">
                    @forelse($tasks as $task)
                        <div class="p-3 rounded-lg bg-gray-50 dark:bg-gray-800">
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $task_statuses[$task->task_status]['class'] ?? '' }}">
                                    {{ $task_statuses[$task->task_status]['label'] ?? $task->task_status }}
                                </span>
                                <span class="flex-1 text-sm">{{ $task->task_name }}</span>
                            </div>
                            @if($task->project)
                                <div class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ $task->project->project_name }}
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('No tasks found') }}</p>
                    @endforelse
                </div>
            </x-filament::section>
        </div>
    @endif
</x-filament-panels::page>
