<table class="table table-horizontal table-striped">
    <thead>
    <tr>
        <th>Tube</th>
        <th>current-jobs-urgent</th>
        <th>current-jobs-ready</th>
        <th>current-jobs-reserved</th>
        <th>current-jobs-delayed</th>
        <th>current-jobs-buried</th>
        <th>current-using</th>
        <th>current-watching</th>
        <th>total-jobs</th>
        <th>cmd-delete</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($tubes as $name => $stats)
        <tr>
            <td>
                <a href="{{ route('beanstalkd.tubes.show', ['tube' => $name]) }}">{{ $name }}</a>
            </td>

            <td>{{ $stats['current-jobs-urgent'] }}</td>
            <td>{{ $stats['current-jobs-ready'] }}</td>
            <td>{{ $stats['current-jobs-reserved'] }}</td>
            <td>{{ $stats['current-jobs-delayed'] }}</td>
            <td>{{ $stats['current-jobs-buried'] }}</td>
            <td>{{ $stats['current-using'] }}</td>
            <td>{{ $stats['current-watching'] }}</td>
            <td>{{ $stats['total-jobs'] }}</td>
            <td>{{ $stats['cmd-delete'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
