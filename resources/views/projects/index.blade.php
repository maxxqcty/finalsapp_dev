@extends('layouts.layout')

@section('title', 'All Projects')

@section('content')

    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-xl font-medium text-neutral-900 tracking-tight">Projects</h1>
            <p class="text-sm text-neutral-400 mt-1">Manage and track all your internal company projects.</p>
        </div>
        <a href="{{ route('projects.create') }}"
           class="inline-flex items-center gap-2 bg-black text-white px-4 py-2 rounded text-sm font-medium hover:bg-neutral-800 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Add project
        </a>
    </div>

    {{-- Projects Table --}}
    <div class="bg-white rounded border border-neutral-200 overflow-hidden">
        @if ($projects->isEmpty())
            <div class="text-center py-20 px-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-neutral-200 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <p class="text-neutral-700 font-medium text-sm">No projects yet</p>
                <p class="text-neutral-400 text-sm mt-1">Get started by creating your first project.</p>
                <a href="{{ route('projects.create') }}"
                   class="mt-5 inline-block bg-black text-white px-4 py-2 rounded text-sm font-medium hover:bg-neutral-800 transition-colors">
                    Create project
                </a>
            </div>
        @else
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-neutral-50 border-b border-neutral-200">
                        <th class="text-left px-6 py-3 text-xs font-medium text-neutral-400 uppercase tracking-wider">#</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-neutral-400 uppercase tracking-wider">Title</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-neutral-400 uppercase tracking-wider">Description</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-neutral-400 uppercase tracking-wider">Status</th>
                        <th class="text-left px-6 py-3 text-xs font-medium text-neutral-400 uppercase tracking-wider">Due date</th>
                        <th class="text-center px-6 py-3 text-xs font-medium text-neutral-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @foreach ($projects as $project)
                        <tr class="hover:bg-neutral-50 transition-colors">
                            <td class="px-6 py-4 text-neutral-300 font-mono text-xs">{{ $project->id }}</td>

                            <td class="px-6 py-4">
                                <span class="font-medium text-neutral-900">{{ $project->title }}</span>
                            </td>

                            <td class="px-6 py-4 text-neutral-400 max-w-xs">
                                <span class="line-clamp-2">{{ Str::limit($project->description, 80) }}</span>
                            </td>

                            <td class="px-6 py-4">
                           @php
    $statusColors = [
        'Pending'     => 'bg-yellow-100 text-yellow-700',
        'In Progress' => 'bg-blue-100 text-blue-700',
        'Completed'   => 'bg-green-100 text-green-700',
    ];
    $colorClass = $statusColors[$project->status] ?? 'bg-neutral-100 text-neutral-500';
@endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium {{ $colorClass }}">
                                    {{ $project->status }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-neutral-400">
                                {{ $project->due_date ? $project->due_date->format('M d, Y') : 'No Due Date' }}
                            </td>

                            <td class="px-6 py-4">
    <div class="flex items-center justify-center gap-2">
        {{-- Edit Button --}}
        <a href="{{ route('projects.edit', $project) }}"
           class="inline-flex items-center gap-1 text-xs font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Edit
        </a>

        {{-- Delete Button --}}
        <form action="{{ route('projects.destroy', $project) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this project?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="inline-flex items-center gap-1 text-xs font-medium text-red-600 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Delete
            </button>
        </form>
    </div>
</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

@endsection