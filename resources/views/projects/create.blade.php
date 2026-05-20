@extends('layouts.layout')

@section('title', 'Create Project')

@section('content')

    {{-- Page Header --}}
    <div class="mb-8">
        <a href="{{ route('projects.index') }}"
           class="inline-flex items-center gap-1 text-sm text-neutral-400 hover:text-neutral-900 transition-colors mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Back to projects
        </a>
        <h1 class="text-xl font-medium text-neutral-900 tracking-tight">Create project</h1>
        <p class="text-sm text-neutral-400 mt-1">Fill in the details below to add a new project.</p>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded border border-neutral-200 max-w-2xl mx-auto">
        <div class="px-6 py-4 border-b border-neutral-100">
            <h2 class="text-sm font-medium text-neutral-700">Project details</h2>
        </div>

        <form action="{{ route('projects.store') }}" method="POST" class="px-6 py-6 space-y-5">
            @csrf

            {{-- Title --}}
            <div>
                <label for="title" class="block text-xs font-medium text-neutral-500 uppercase tracking-wider mb-1.5">
                    Title <span class="text-red-400">*</span>
                </label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title') }}"
                    placeholder="e.g. Website Redesign"
                    class="w-full px-3 py-2 border rounded text-sm text-neutral-900 placeholder-neutral-300 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition
                           {{ $errors->has('title') ? 'border-red-300 bg-red-50' : 'border-neutral-200' }}"
                >
                @error('title')
                    <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-xs font-medium text-neutral-500 uppercase tracking-wider mb-1.5">
                    Description <span class="text-red-400">*</span>
                </label>
                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    placeholder="Briefly describe the project goals and scope..."
                    class="w-full px-3 py-2 border rounded text-sm text-neutral-900 placeholder-neutral-300 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition resize-none
                           {{ $errors->has('description') ? 'border-red-300 bg-red-50' : 'border-neutral-200' }}"
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Status & Due Date --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                {{-- Status --}}
                <div>
                    <label for="status" class="block text-xs font-medium text-neutral-500 uppercase tracking-wider mb-1.5">
                        Status <span class="text-red-400">*</span>
                    </label>
                    <select
                        id="status"
                        name="status"
                        class="w-full px-3 py-2 border rounded text-sm text-neutral-900 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition
                               {{ $errors->has('status') ? 'border-red-300 bg-red-50' : 'border-neutral-200' }}"
                    >
                        <option value="Pending"     {{ old('status', 'Pending') === 'Pending'     ? 'selected' : '' }}>Pending</option>
                        <option value="In Progress" {{ old('status') === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Completed"   {{ old('status') === 'Completed'   ? 'selected' : '' }}>Completed</option>
                    </select>
                    @error('status')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Due Date --}}
                <div>
                    <label for="due_date" class="block text-xs font-medium text-neutral-500 uppercase tracking-wider mb-1.5">
                        Due date <span class="text-neutral-300 normal-case font-normal">(optional)</span>
                    </label>
                    <input
                        type="date"
                        id="due_date"
                        name="due_date"
                        value="{{ old('due_date') }}"
                        class="w-full px-3 py-2 border rounded text-sm text-neutral-900 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition
                               {{ $errors->has('due_date') ? 'border-red-300 bg-red-50' : 'border-neutral-200' }}"
                    >
                    @error('due_date')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex items-center gap-3 pt-4 border-t border-neutral-100">
                <button type="submit"
                        class="bg-black text-white px-5 py-2 rounded text-sm font-medium hover:bg-neutral-800 transition-colors">
                    Create project
                </button>
                <a href="{{ route('projects.index') }}"
                   class="text-sm text-neutral-400 hover:text-neutral-700 transition-colors px-3 py-2">
                    Cancel
                </a>
            </div>
        </form>
    </div>

@endsection