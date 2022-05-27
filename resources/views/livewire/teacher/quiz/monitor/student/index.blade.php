<div>
    <div>
        <livewire:teacher.quiz.monitor.graphs.student.kcs-radar :student="$student" :quiz="$quiz" />
    </div>
    <div>
        {{-- quiz sutudent's logs --}}
        <livewire:teacher.quiz.monitor.logs.student.index :student="$student" :quiz="$quiz" />
    </div>
</div>