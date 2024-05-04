<x-layout page="Login">
    <x-slot:btn>
        <a href="{{ route('home') }}" class="btn btn-primary">Voltar</a>
    </x-slot:btn>

    <section id="task_section">
        <h1>Criar tarefa</h1>
        <form method="POST" action="{{ route('task.create_action') }}">
            @csrf
            <x-form.text_input name='title' label='Titulo da Task' placeholder="Digite o titulo da sua task" />

            <x-form.text_input name='due_date' label='Data da realização' type="datetime-local"
                placeholder='Escolha a data da tarefa' required='required' />

            <x-form.select_input name='category_id' label='Categoria'>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </x-form.select_input>

            <x-form.textarea_input name='description' label='Descrição da tarefa'
                placeholder='Digite uma descrição para sua tarefa' />


            <div class="input_area">
                <x-form.button_input type="reset">Resetar</x-form.button_input>
                <x-form.button_input type="submit">Criar tarefa</x-form.button_input>
            </div>
        </form>
    </section>

</x-layout>
