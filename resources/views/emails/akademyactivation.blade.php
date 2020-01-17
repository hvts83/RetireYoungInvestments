Los siguientes cursos requieren revisión de actividad:
<br>
<table>
    <thead>
        <tr>
            <th>Usuario</th>
            <th>Correo</th>
            <th>Curso</th>
            <th>Ultima activación</th>
        </tr>
    </thead>
    <tbody>
        @php
            $today = Carbon\Carbon::now();
        @endphp
        @foreach ( $composeMail['list'] as $key => $cours)
            @php
                $diference = $today->diffInDays( $cours->date_activation);
            @endphp
            <tr>
                <td>{{ $cours->user }}</td>
                <td>{{ $cours->email }}</td>
                <td>{{ $cours->course }}</td>
                <td>{{ $diference }} días </td>
            </tr>
        @endforeach
    </tbody>
</table>