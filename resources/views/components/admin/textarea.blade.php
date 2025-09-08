@props(['disabled' => false])

<div class="relative">
    <div class="mb-2 flex items-center space-x-2 border-b pb-2">
        <button type="button" onclick="formatText('bold')" class="p-1 hover:bg-gray-100 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M12.8 10c0-1.1-.9-2-2-2H8V6h2.8c2.2 0 4 1.8 4 4s-1.8 4-4 4H8v-2h2.8c1.1 0 2-.9 2-2z"/>
                <path d="M10.8 14H8v-2h2.8c1.1 0 2-.9 2-2s-.9-2-2-2H8V6h2.8c2.2 0 4 1.8 4 4s-1.8 4-4 4z"/>
            </svg>
        </button>
        <button type="button" onclick="formatText('italic')" class="p-1 hover:bg-gray-100 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M12 6v8h-1.5l-5-8H7v8H5.5V6H7l5 8h-1.5V6H12z"/>
            </svg>
        </button>
        <button type="button" onclick="formatText('underline')" class="p-1 hover:bg-gray-100 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 16a4 4 0 004-4V4h-2v8a2 2 0 11-4 0V4H6v8a4 4 0 004 4zM4 18v-2h12v2H4z"/>
            </svg>
        </button>
        <div class="h-5 w-px bg-gray-300"></div>
        <button type="button" onclick="formatList('bullet')" class="p-1 hover:bg-gray-100 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M4 6h2v2H4V6zm0 5h2v2H4v-2zm0 5h2v2H4v-2zm4-10h12v2H8V6zm0 5h12v2H8v-2zm0 5h12v2H8v-2z"/>
            </svg>
        </button>
        <button type="button" onclick="formatList('number')" class="p-1 hover:bg-gray-100 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M4 6h2v2H4V6zm4 0h12v2H8V6zm-4 5h2v2H4v-2zm4 0h12v2H8v-2zm-4 5h2v2H4v-2zm4 0h12v2H8v-2z"/>
            </svg>
        </button>
        <div class="h-5 w-px bg-gray-300"></div>
        <button type="button" onclick="formatAlign('left')" class="p-1 hover:bg-gray-100 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M3 6h14v2H3V6zm0 5h10v2H3v-2zm0 5h14v2H3v-2z"/>
            </svg>
        </button>
        <button type="button" onclick="formatAlign('center')" class="p-1 hover:bg-gray-100 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M3 6h14v2H3V6zm2 5h10v2H5v-2zm-2 5h14v2H3v-2z"/>
            </svg>
        </button>
        <button type="button" onclick="formatAlign('right')" class="p-1 hover:bg-gray-100 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M3 6h14v2H3V6zm4 5h10v2H7v-2zm-4 5h14v2H3v-2z"/>
            </svg>
        </button>
    </div>
    <textarea
        {{ $disabled ? 'disabled' : '' }}
        {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full min-h-[200px]']) !!}
        onselect="saveSelection()"
    >{{ $slot }}</textarea>
</div>

<script>
let lastSelection = null;

function saveSelection() {
    const textarea = document.activeElement;
    if (textarea.tagName.toLowerCase() === 'textarea') {
        lastSelection = {
            start: textarea.selectionStart,
            end: textarea.selectionEnd
        };
    }
}

function formatText(style) {
    if (!lastSelection) return;
    
    const textarea = document.activeElement;
    if (textarea.tagName.toLowerCase() !== 'textarea') return;
    
    const text = textarea.value;
    let prefix = '', suffix = '';
    
    switch(style) {
        case 'bold':
            prefix = '**';
            suffix = '**';
            break;
        case 'italic':
            prefix = '_';
            suffix = '_';
            break;
        case 'underline':
            prefix = '__';
            suffix = '__';
            break;
    }
    
    const newText = text.substring(0, lastSelection.start) +
                    prefix +
                    text.substring(lastSelection.start, lastSelection.end) +
                    suffix +
                    text.substring(lastSelection.end);
    
    textarea.value = newText;
    textarea.focus();
}

function formatList(type) {
    if (!lastSelection) return;
    
    const textarea = document.activeElement;
    if (textarea.tagName.toLowerCase() !== 'textarea') return;
    
    const text = textarea.value;
    const selectedText = text.substring(lastSelection.start, lastSelection.end);
    const lines = selectedText.split('\n');
    
    const prefix = type === 'bullet' ? '* ' : '1. ';
    const formattedLines = lines.map(line => prefix + line);
    
    const newText = text.substring(0, lastSelection.start) +
                    formattedLines.join('\n') +
                    text.substring(lastSelection.end);
    
    textarea.value = newText;
    textarea.focus();
}

function formatAlign(alignment) {
    if (!lastSelection) return;
    
    const textarea = document.activeElement;
    if (textarea.tagName.toLowerCase() !== 'textarea') return;
    
    const text = textarea.value;
    const selectedText = text.substring(lastSelection.start, lastSelection.end);
    const lines = selectedText.split('\n');
    
    let prefix = '';
    switch(alignment) {
        case 'left':
            prefix = '::: left\n';
            break;
        case 'center':
            prefix = '::: center\n';
            break;
        case 'right':
            prefix = '::: right\n';
            break;
    }
    
    const newText = text.substring(0, lastSelection.start) +
                    prefix +
                    selectedText +
                    '\n:::' +
                    text.substring(lastSelection.end);
    
    textarea.value = newText;
    textarea.focus();
}
</script>