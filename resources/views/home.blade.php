<x-layout>
    <x-slot:btn>
        <a href="{{ route('task.create') }}" class="btn btn-primary">Criar tarefa</a>
        <a href="{{ route('logout') }}" class="btn btn-primary">Sair</a>
    </x-slot:btn>
    <section class="graph">
        <div class="graph_header">
            <div>
                <h2>Progresso do dia</h2>
                {{-- <p>{{ $AuthUser->name }}</p> --}}
            </div>
            <hr>
            <div class="graph_header_date">
                <a href="{{ route('home', ['date' => $date_prev_button]) }}"><i
                        class="fa-regular fa-square-caret-left"></i></a>
                <span>{{ $date_as_string }}</span>
                <a href="{{ route('home', ['date' => $date_next_button]) }}"><i
                        class="fa-regular fa-square-caret-right"></i></a>
            </div>
        </div>
        <div class="graph_header_subtitle">
            tarefas <b>3/6</b>
        </div>


        <div class="graph_placeholder">

        </div>

        <p class="graph_header_tasks_left">Restam 3 tarefas para serem realizadas</p>
    </section>

    <section class="list">
        <div class="list_header">
            <select class="list_header_select" onchange="changeTaskStatusFilter(this)">
                <option value="all_task">Todas as tarefas</option>
                <option value="task_pending">Tarefas pendentes</option>
                <option value="task_done">Tarefas realizadas</option>
            </select>
        </div>
        <div class="task_list">
            @foreach ($tasks as $task)
                <x-task :data=$task />
            @endforeach
        </div>
    </section>

    <script>
        async function taskUpdate(element) {
            let status = element.checked;
            let taskId = element.dataset.id;
            let url = '{{ route('task.update') }}'
            // alert(url);
            let rawResult = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-type': 'application/json',
                    'accept': 'application/json'
                },
                body: JSON.stringify({
                    status,
                    taskId,
                    _token: '{{ csrf_token() }}'
                })
            })

            result = await rawResult.json()
            if (result.success) {
                alert('Task atualizada com sucesso!')
            } else {
                element.checked = !status;
            }

        }

        function changeTaskStatusFilter(e) {
            if (e.value == 'task_pending') {
                showAllTasks();
                document.querySelectorAll('.task_done').forEach(function(element) {
                    element.style.display = 'none';
                });
            } else if (e.value == 'task_done') {
                showAllTasks();
                document.querySelectorAll('.task_pending').forEach(function(element) {
                    element.style.display = 'none';
                });
            } else {
                showAllTasks();
            }
        }

        function showAllTasks() {
            document.querySelectorAll('.task2').forEach(function(element) {
                element.style.display = 'block';
            });
        }
    </script>
</x-layout>
