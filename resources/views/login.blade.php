<x-layout page="Login">
    <x-slot:btn>
        <a href="{{ route('register') }}" class="btn btn-primary">Registre-se</a>
    </x-slot:btn>

    <section id="task_section">
        <h1>Fazer login</h1>
        @if ($errors->any())
            <ul class="alert alert-error">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form method="POST" action="{{ route('user.login_action') }}">
            @csrf
            <x-form.text_input name='email' label='Seu email' type="email" placeholder='Digite seu email' />

            <x-form.text_input name='password' label='Sua senha' type="password" placeholder='Digite sua senha' />

            <div class="input_area">
                <x-form.button_input type="reset">Limpar</x-form.button_input>
                <x-form.button_input type="submit">Entrar</x-form.button_input>
            </div>
        </form>
    </section>

</x-layout>
