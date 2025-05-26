{{-- resources/views/messages/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="px-6 py-8 bg-gray-900 text-white min-h-screen">
    <div class="flex items-center justify-between mb-6">
        <div>
            <a href="{{ route('messages.index') }}" class="text-gray-300 hover:text-white transition duration-200 inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back to Messages
            </a>
            <h1 class="text-2xl font-bold text-white mt-2">{{ $conversation->subject }}</h1>
        </div>
        
        @if($conversation->job)
        <div class="bg-gray-700 px-3 py-2 rounded-lg">
            <span class="text-sm text-gray-300">Related to job:</span>
            <a href="{{ route('jobs.show', $conversation->job->id_job) }}" class="text-[#B9FF66] text-sm hover:underline ml-1">
                {{ $conversation->job->title }}
            </a>
        </div>
        @endif
    </div>
    
    @if(session('success'))
    <div class="bg-green-900 border-l-4 border-green-500 text-green-300 p-4 mb-6" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif
    
    <div class="bg-gray-800 rounded-xl shadow-md border border-gray-700 overflow-hidden">
        <div class="p-4 border-b border-gray-700">
            <div class="flex items-center">
                <div class="text-sm text-gray-400">
                    Participants:
                    @foreach($conversation->participants as $participant)
                        <span class="ml-1 {{ $participant->id === auth()->id() ? 'text-[#B9FF66]' : 'text-white' }}">
                            @if($participant->role === 'admin' && $participant->companyProfile)
                                {{ $participant->companyProfile->name }} (Company)
                            @else
                                {{ $participant->name }}
                            @endif
                            {{ !$loop->last ? ',' : '' }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="divide-y divide-gray-700">
            @foreach($conversation->messages as $message)
                <div class="p-4 {{ $message->sender->id === auth()->id() ? 'bg-gray-750' : '' }}">
                    <div class="flex">
                        <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center text-lg mr-3 flex-shrink-0">
                            {{ substr($message->sender->name, 0, 1) }}
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h3 class="font-medium text-white">
                                    @if($message->sender->role === 'admin' && $message->sender->companyProfile)
                                        {{ $message->sender->companyProfile->name }}
                                    @else
                                        {{ $message->sender->name }}
                                    @endif
                                </h3>
                                <span class="text-xs text-gray-400">{{ $message->created_at->format('M d, Y g:i A') }}</span>
                            </div>
                            <div class="mt-2 text-gray-300 whitespace-pre-wrap">{{ $message->body }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="p-4 bg-gray-750">
            <form action="{{ route('messages.reply', $conversation->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="message" class="block text-sm font-medium text-gray-300 mb-1">Reply</label>
                    <textarea id="message" name="message" rows="3" required
                        class="w-full px-4 py-2 bg-white border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]"></textarea>
                    @error('message')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="bg-[#B9FF66] hover:bg-[#a7e55c] text-gray-900 font-medium py-2 px-6 rounded-lg transition duration-200">
                        Send Reply
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
