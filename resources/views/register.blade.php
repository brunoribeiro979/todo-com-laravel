<x-layout page="Login">
    <x-slot:btn>
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
    </x-slot:btn>

    <section id="task_section">
        <h1>Registrar-se</h1>
        @if ($errors->any())
            <ul class="alert alert-error">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form method="POST" action="{{ route('user.register_action') }}">
            @csrf
            <x-form.text_input name='name' label='Seu nome' placeholder="Digite seu nome" />

            <x-form.text_input name='email' label='Seu email' type="email" placeholder='Digite seu email' />

            <x-form.text_input name='password' label='Sua senha' type="password" placeholder='Digite sua senha' />

            <x-form.text_input name='password_confirmation' label='Confirme sua senha' type="password"
                placeholder='Digite sua a confirmação de senha' />

            <div class="input_area">
                <x-form.button_input type="reset">Limpar</x-form.button_input>
                <x-form.button_input type="submit">Registrar-se</x-form.button_input>
            </div>
        </form>
    </section>

</x-layout>
