<x-layout title="Novo usuario">
    <form method="post" class="mt-3">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">Nome:</label>
            <input type="name" name="name" id="name" class="form-control">
       </div>
       <div class="form-group">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" name="email" id="email" class="form-control">
       </div>
       <div class="form-group">
            <label for="password" class="form-label">Senha:</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <button class="btn btn-primary mt-3" type="submit">Registrar</button>
        <a href="{{route('login')}}" class="btn btn-secondary mt-3">Login</a>
    </form>

</x-layout >