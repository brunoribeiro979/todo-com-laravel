<x-layout page="Login">
    <x-slot:btn>
        <a href="{{ route('home') }}" class="btn btn-primary">Voltar</a>
    </x-slot:btn>
    <section id="task_section">
        <h1>Editar tarefa</h1>
        <form method="POST" action="{{ route('task.edit_action') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $task->id }}">

            <x-form.checkbox_input name='is_done' label='Tarefa realizada?' checked="{{ $task->is_done }}" />

            <x-form.text_input name='title' label='Titulo da Task' placeholder="Digite o titulo da sua task"
                value="{{ $task->title }}" />

            <x-form.text_input name='due_date' label='Data da realização' type="datetime-local" required='required'
                value="{{ $task->due_date }}" />

            <x-form.select_input name='category_id' label='Categoria'>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($category->id == $task->category_id) selected @endif>
                        {{ $category->title }}
                    </option>
                @endforeach
            </x-form.select_input>

            <x-form.textarea_input name='description' label='Descrição da tarefa'
                placeholder='Digite uma descrição para sua tarefa' value="{{ $task->description }}" />


            <div class="input_area">
                <x-form.button_input type="reset">Resetar</x-form.button_input>
                <x-form.button_input type="submit">Atualizar tarefa</x-form.button_input>
            </div>
        </form>
    </section>

</x-layout>
