<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tasks</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f7fb; color: #111; }
        .wrap { max-width: 860px; margin: 40px auto; padding: 0 16px; }
        .card { background: #fff; border-radius: 12px; padding: 16px; box-shadow: 0 8px 20px rgba(0,0,0,0.06); }
        .list { margin-top: 20px; display: grid; gap: 12px; }
        .item { background: #fff; border-radius: 12px; padding: 12px; border: 1px solid #e6e9f2; }
        .row { display: grid; gap: 8px; }
        input, textarea { width: 100%; padding: 10px; border: 1px solid #d7dbe6; border-radius: 8px; }
        textarea { min-height: 80px; }
        .btn-main { background: #2e6bff; color: #fff; border: 0; padding: 10px 14px; border-radius: 8px; cursor: pointer; }
        .meta { font-size: 12px; color: #6b7280; }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="header-row">
            <h1 style="margin:0;">Tareas</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn-logout" type="submit">Salir</button>
            </form>
        </div>
        <div class="meta user-meta">Usuario: {{ $user->username }} ({{ $user->role }})</div>
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form class="card row" method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <input type="text" name="title" placeholder="Título" required>
            <textarea name="body" placeholder="Detalles"></textarea>
            <button class="btn-main" type="submit">Agregar</button>
        </form>

        <div class="list">
            @forelse ($tasks as $task)
                <div class="item task-row">
                    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="done" value="1">
                        <button class="btn-done{{ $task->done ? ' done' : '' }}" type="submit">✓</button>
                    </form>
                    <div class="task-main">
                        <div class="task-title{{ $task->done ? ' done' : '' }}">{{ $task->title }}</div>
                        <div class="meta">{{ $task->body }}</div>
                        <div class="meta">Creada por: {{ $task->user->username ?? 'N/A' }}</div>
                    </div>
                    <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete" type="submit">🗑️</button>
                    </form>
                </div>
            @empty
                <div class="item meta">No hay tareas aún</div>
            @endforelse
        </div>
    </div>
</body>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f7fb; color: #111; }
        .wrap { max-width: 860px; margin: 40px auto; padding: 0 16px; }
        .header-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px; }
        .user-meta { margin-bottom: 16px; }
        .card { background: #fff; border-radius: 12px; padding: 16px; box-shadow: 0 8px 20px rgba(0,0,0,0.06); }
        .list { margin-top: 20px; display: grid; gap: 12px; }
        .item { background: #fff; border-radius: 12px; padding: 12px; border: 1px solid #e6e9f2; }
        .task-row { display: flex; align-items: center; gap: 12px; min-height: 48px; }
        .task-main { flex: 1; }
        .task-title { font-weight: bold; font-size: 16px; }
        .task-title.done { text-decoration: line-through; color: #6b7280; }
        .btn-main, .btn-done, .btn-delete, .btn-logout { border: 0; border-radius: 8px; cursor: pointer; font-size: 16px; padding: 6px 10px; min-width: 32px; }
        .btn-main { background: #2e6bff; color: #fff; }
        .btn-done { background: #e5e7eb; color: #111; }
        .btn-done.done { background: #16a34a; color: #fff; }
        .btn-delete { background: #e53e3e; color: #fff; }
        .btn-logout { background: #e5e7eb; color: #111; font-size: 14px; padding: 6px 16px; min-width: 0; }
        .row { display: grid; gap: 8px; }
        input, textarea { width: 100%; padding: 10px; border: 1px solid #d7dbe6; border-radius: 8px; }
        textarea { min-height: 80px; }
        .meta { font-size: 12px; color: #6b7280; }
        .alert { padding: 10px 16px; border-radius: 8px; margin-bottom: 12px; }
        .alert-error { background: #ffe0e0; color: #b91c1c; }
        .alert-success { background: #e0ffe0; color: #166534; }
    </style>
