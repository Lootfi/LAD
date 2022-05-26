<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $subject }}</h1>
                <p>{{ $content }}</p>
            </div>
        </div>
    </div>

    <div class="container">
        Thanks,<br>
        {{ config('app.name') }}
    </div>
</body>