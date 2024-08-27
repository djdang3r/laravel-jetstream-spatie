<table>
    <thead>
        <tr>ID</tr>
        <tr>User Name</tr>
        <tr>Email</tr>
        <tr>Actions</tr>
    </thead>

    <tbody>
        @foreach ($users as $user)
            <tr>{{ $user->id }}</tr>
            <tr>{{ $user->name }}/tr>
            <tr>{{ $user->email }}</tr>
            <tr></tr>
        @endforeach
    </tbody>
</table>