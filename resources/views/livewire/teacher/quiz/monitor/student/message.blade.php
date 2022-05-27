<div>
    <form wire:submit.prevent="send">
        {{-- form-group: student name --}}
        <div class="form-group">
            <label for="student_name">Student Name</label>
            <input disabled type="text" class="form-control" id="student_name" value="{{$student->name}}"
                placeholder="Enter student name" />
        </div>
        {{-- form-group: message method: in-app notification or via email --}}
        <div class="form-group">
            <label for="message_method">Message Method</label>
            <select class="form-control" id="message_method" wire:model="message_method">
                <option value="in-app">In-app notification</option>
                <option value="email">Email</option>
            </select>
        </div>
        {{-- form-group: student's email, if chosen method is email --}}
        @if ($message_method == 'email')
        <div class="form-group" id="email_group">
            <label for="email">Student Email</label>
            <input disabled type="email" class="form-control" id="email" placeholder="Enter student email"
                wire:model="email" />
        </div>
        {{-- email subject --}}
        <div class="form-group">
            <label for="message_subject">Message Subject</label>
            <input type="text" class="form-control" id="message_subject" placeholder="Enter message subject"
                wire:model="message_subject" />
        </div>
        @endif
        {{-- form-group: message content --}}
        <div class="form-group">
            <label for="message_content">Message Content</label>
            <textarea class="form-control" id="message_content" rows="5" wire:model="message_content"
                placeholder="Enter message content" maxlength="@if($message_method == 'email')
                500
                @else
                140
                @endif"></textarea>
        </div>
        {{-- form-group: send button --}}
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>
</div>

@section('js')
<script>
    Livewire.on('closeWindow', () => {
        toastr.options = {
            "closeButton": false,
            "newestOnTop": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "showEasing": "swing",
            "showMethod": "fadeIn",
            'timeOut': 0,
            'extendedTimeOut': 0, 
        }
        toastr.success("Message Sent Successfully!, <br> This window will close in 2 seconds.")
        setTimeout(() => window.close(), 2000)
        
    })
</script>
@endsection