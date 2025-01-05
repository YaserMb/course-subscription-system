@props(['courses', 'downloadedCourses'])

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
    @foreach ($courses as $course)
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold mb-2">{{ $course->name }}</h3>
            <p class="text-gray-600 mb-4">{{ $course->description }}</p>

            @if ($downloadedCourses->contains($course->id))
                <span class="inline-block bg-green-100 text-green-800 px-4 py-2 rounded-md">
                    Downloaded
                </span>
            @else
                <button
                    data-course-id="{{ $course->id }}"
                    class="download-btn bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition-colors"
                >
                    Download Course
                </button>
            @endif
        </div>
    @endforeach
</div>

<script>
$(document).ready(function() {
    $('.download-btn').on('click', function() {
        const button = $(this);
        const courseId = button.data('course-id');

        // Disable button and show loading state
        button.prop('disabled', true).text('Downloading...');

        $.ajax({
            url: `/courses/${courseId}/download`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Replace button with downloaded label
                button.replaceWith(`
                    <span class="inline-block bg-green-100 text-green-800 px-4 py-2 rounded-md">
                        Downloaded
                    </span>
                `);
                showNotification('Course downloaded successfully!', 'success');
            },
            error: function(xhr) {
                // Re-enable button
                button.prop('disabled', false).text('Download Course');

                // Show error message
                const message = xhr.responseJSON?.message || 'Failed to download course. Please try again.';
                showNotification(message, 'error');
            }
        });
    });
});
</script>
