<table class="table table-horizontal table-striped">
    <thead>
        <tr>
            <th>Tube</th>

            @foreach ($tubes as $name => $stats)
                @foreach ($stats as $key => $stat)
                    <th>{{ $key }}</th>
                @endforeach
            @endforeach
        </tr>
    </thead>

    <tbody>
    @foreach ($tubes as $name => $stats)
        <tr>
            <td>
                <a href="{{ route('beanstalkd.tubes.show', ['tube' => $name]) }}">{{ $name }}</a>
            </td>

            @foreach ($stats as $stat)
                <td>{{ $stat }}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
