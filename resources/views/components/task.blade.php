<div class="task2 {{ $data['is_done'] ? 'task_done' : 'task_pending' }}">
    <div class="task">
        <div class="title">
            <input onchange="taskUpdate(this)" data-id="{{ $data['id'] }}" type="checkbox"
                @if ($data && $data['is_done']) checked @endif>
            <div class="task_title">{{ $data['title'] ?? '' }}</div>
        </div>
        <div class="priority">
            <div class="sphere"></div>
            <div>{{ $data['category']->title ?? '' }}</div>
        </div>
        <div class="actions">
            <a href="{{ route('task.edit', ['id' => $data['id']]) }}"><i class="fa-solid fa-pen"></i></a>
            <a href="{{ route('task.delete', ['id' => $data['id']]) }}"><i class="fa-solid fa-trash-can"></i></a>
        </div>
    </div>

</div>
