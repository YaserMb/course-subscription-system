@props(['type' => 'success'])

@php
    $classes = [
        'success' => 'bg-green-100 border-green-400 text-green-700',
        'error' => 'bg-red-100 border-red-400 text-red-700',
    ][$type];
@endphp

<div id="notification" style="display: none;" class="fixed top-4 right-4 px-4 py-3 border rounded {{ $classes }} max-w-md" role="alert">
    <span id="notification-message" class="block sm:inline"></span>
    <button onclick="this.parentElement.style.display='none'" class="absolute top-0 bottom-0 right-0 px-4 py-3">
        <svg class="fill-current h-6 w-6" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <title>Close</title>
            <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
        </svg>
    </button>
</div>

<script>
function showNotification(message, type = 'success') {
    const $notification = $('#notification');
    const $messageElement = $('#notification-message');

    $notification.attr('class', `fixed top-4 right-4 px-4 py-3 border rounded max-w-md ${
        type === 'success' ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700'
    }`);

    $messageElement.text(message);
    $notification.show();

    // Auto hide after 10 seconds
    setTimeout(() => {
        $notification.hide();
    }, 10000);
}
</script>
