@if (session()->has('message_success'))
<div class="toast show align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
    data-bs-animation="true" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body">
            <svg width="1.25em" height="1.25em" class="bi bi-shield-fill-check" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M8 .5c-.662 0-1.77.249-2.813.525a61.11 61.11 0 0 0-2.772.815 1.454 1.454 0 0 0-1.003 1.184c-.573 4.197.756 7.307 2.368 9.365a11.192 11.192 0 0 0 2.417 2.3c.371.256.715.451 1.007.586.27.124.558.225.796.225s.527-.101.796-.225c.292-.135.636-.33 1.007-.586a11.191 11.191 0 0 0 2.418-2.3c1.611-2.058 2.94-5.168 2.367-9.365a1.454 1.454 0 0 0-1.003-1.184 61.09 61.09 0 0 0-2.772-.815C9.77.749 8.663.5 8 .5zm2.854 6.354a.5.5 0 0 0-.708-.708L7.5 8.793 6.354 7.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
            </svg>
            <strong class="me-auto">Success!</strong><br>
            {{ session('message_success') }}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
            aria-label="Close"></button>
    </div>
</div>
@endif

@if (session()->has('message_success_login'))
<div class="toast show align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
    data-bs-animation="true" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body">
            <svg width="1.25em" height="1.25em" class="bi bi-shield-fill-check" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M8 .5c-.662 0-1.77.249-2.813.525a61.11 61.11 0 0 0-2.772.815 1.454 1.454 0 0 0-1.003 1.184c-.573 4.197.756 7.307 2.368 9.365a11.192 11.192 0 0 0 2.417 2.3c.371.256.715.451 1.007.586.27.124.558.225.796.225s.527-.101.796-.225c.292-.135.636-.33 1.007-.586a11.191 11.191 0 0 0 2.418-2.3c1.611-2.058 2.94-5.168 2.367-9.365a1.454 1.454 0 0 0-1.003-1.184 61.09 61.09 0 0 0-2.772-.815C9.77.749 8.663.5 8 .5zm2.854 6.354a.5.5 0 0 0-.708-.708L7.5 8.793 6.354 7.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
            </svg>
            <strong class="me-auto">Welcome!</strong><br>
            {{ session('message_success_login') }}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
            aria-label="Close"></button>
    </div>
</div>
@endif

@if (session()->has('message_failed'))
<div class="toast show align-items-center text-bg-danger border-0" role="alert" aria-live="assertive"
    data-bs-animation="true" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body">
            <svg width="1.25em" height="1.25em" class="bi bi-exclamation-circle-fill" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
            </svg>
            <strong class="me-auto">Failed!</strong><br>
            {{ session('message_failed') }}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
            aria-label="Close"></button>
    </div>
</div>
@endif

@if ($errors->any())
<div class="toast show align-items-center text-bg-danger border-0" role="alert" aria-live="assertive"
    data-bs-animation="true" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body">
            <svg width="1.25em" height="1.25em" class="bi bi-exclamation-circle-fill" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
            </svg>
            <strong class="me-auto">Error!</strong>
            {!! implode('', $errors->all('<div>:message</div>')) !!}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
            aria-label="Close"></button>
    </div>
</div>
@endif