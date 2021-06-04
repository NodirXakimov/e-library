<table>
    <thead>
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Middlename</th>
            <th>Group</th>
            <th>Phone number</th>
            <th>Course</th>
            <th>Email</th>
            <th>Count of given books</th>
        </tr>
    </thead>
    <tbody>
       @if (isset($students))
        @foreach ($students as $student)
            <tr>
                <td>{{ $student->firstname }}</td>
                <td>{{ $student->lastname }}</td>
                <td>{{ $student->middlename }}</td>
                <td>{{ $student->group }}</td>
                <td>{{ $student->phone_number }}</td>
                <td>{{ $student->course }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ Count($student->debts) }}</td>
            </tr>
        @endforeach
       @endif
    </tbody>
</table>