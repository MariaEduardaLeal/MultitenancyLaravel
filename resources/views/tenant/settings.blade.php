<h1>Decore sua Loja 🖌️</h1>

<form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div style="margin-bottom: 20px;">
        <label>Escolha a cor principal:</label>
        <input type="color" name="primary_color" value="{{ tenant('primary_color') }}">
    </div>

    <div style="margin-bottom: 20px;">
        <label>Sua Logo:</label>
        <input type="file" name="logo">
    </div>

    <button type="submit">Salvar Configurações</button>
</form>
