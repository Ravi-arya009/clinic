{{-- resources/views/components/sweet-alert.blade.php --}}
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Helper function to format messages
            const formatMessages = messages => {
                if (Array.isArray(messages)) {
                    return '<ul class="swal-bullet-list"><li>' + messages.join('</li><li>') + '</li></ul>';
                }
                return messages;
            };

            // Configuration for different alert types
            const alerts = {
                'error': {
                    title: 'Error!',
                    messages: {!! $errors->any() ? json_encode($errors->all()) : (session('error') ? json_encode(session('error')) : 'null') !!}
                },
                'success': {
                    title: 'Success!',
                    messages: {!! session('success') ? json_encode(session('success')) : 'null' !!}
                },
                'warning': {
                    title: 'Warning!',
                    messages: {!! session('warning') ? json_encode(session('warning')) : 'null' !!}
                },
                'info': {
                    title: 'Info',
                    messages: {!! session('info') ? json_encode(session('info')) : 'null' !!}
                }
            };

            // Show alerts
            Object.entries(alerts).forEach(([type, config]) => {
                if (config.messages) {
                    Swal.fire({
                        title: config.title,
                        html: formatMessages(config.messages),
                        icon: type,
                        confirmButtonText: 'Ok'
                    });
                }
            });
        });
    </script>
@endpush
