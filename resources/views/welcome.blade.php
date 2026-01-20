<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel RA6 MGR</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f5f5f5;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        h2 {
            color: #666;
            margin-top: 30px;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        th {
            background: #333;
            color: white;
            padding: 12px;
            text-align: left;
        }
        td {
            padding: 10px 12px;
            border-bottom: 1px solid #eee;
        }
        tr:hover {
            background: #f9f9f9;
        }
        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge-admin { background: #dc3545; color: white; }
        .badge-user { background: #007bff; color: white; }
        .badge-active { background: #28a745; color: white; }
        .badge-inactive { background: #6c757d; color: white; }
        .badge-published { background: #28a745; color: white; }
        .badge-draft { background: #ffc107; color: black; }
    </style>
</head>
<body>
    <h1>Laravel RA6 MGR - Listado de Datos</h1>

    <h2>👥 Usuarios ({{ \App\Models\UserMGR::count() }})</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach(\App\Models\UserMGR::all() as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="badge badge-{{ $user->role }}">{{ strtoupper($user->role) }}</span>
                </td>
                <td>
                    <span class="badge badge-{{ $user->active ? 'active' : 'inactive' }}">
                        {{ $user->active ? 'ACTIVO' : 'INACTIVO' }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>📝 Publicaciones ({{ \App\Models\PostMGR::count() }})</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Categoría</th>
                <th>Vistas</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach(\App\Models\PostMGR::with('user')->get() as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->user->name }}</td>
                <td>{{ $post->category }}</td>
                <td>{{ $post->views }}</td>
                <td>
                    <span class="badge badge-{{ $post->is_published ? 'published' : 'draft' }}">
                        {{ $post->is_published ? 'PUBLICADO' : 'BORRADOR' }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
