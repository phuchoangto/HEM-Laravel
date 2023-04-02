@extends('dashboard')

@section('title', 'List student join')

@section('css')
<style>
    #studenttd td p {
        margin-bottom: 0 !important;
    }

    #btn-certificate:hover {
        background-color: #FFBB33 !important;
        color: white !important;
    }
</style>
@endsection

@section('content')
<button type="submit" class="btn btn-primary" id="export-btn"> Xuất dữ liệu</button>
<div class="card mt-3">
    <div class="card-body p-0">
        <table class="table align-middle mb-0 bg-white table-bordered" style="width:100%;">
            <thead class="bg-light">
                <tr>
                    <th style="width:5%;">Id</th>
                    <th style="text-align: center;">Name</th>
                    <th style="text-align: center;">Email</th>
                    <th style="text-align: center;">Checkin At</th>
                    <th style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr id="studenttd" data-id="<?= $student->id ?>">
                    <td style="text-align: center;">
                        <p>{{ $student->id }}</p>
                    </td>
                    <td style="text-align: center;">
                        <p>{{ $student->name }}</p>
                    </td>
                    <td style="text-align: center;">
                        <p>{{ $student->email }}</p>
                    </td>
                    <td style="text-align: center;">
                        <p>{{ $student->pivot->check_in_at }}</p>
                    </td>
                    <td style="text-align: center;">
                        <button id="btn-certificate" class="btn btn-outline-warning btn-rounded btn-sm fw-bold text-warning">
                            <i class="fas fa-certificate"></i>&nbsp Get Certificate
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <nav aria-label="Page navigation example" style="margin-right:5px; padding-top:15px;">
        <ul class="pagination justify-content-end">
            <li class="page-item {{ $students->previousPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $students->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $students->previousPageUrl() ? 'false' : 'true' }}">Previous</a>
            </li>
            @for($i=1;$i<=$students->lastPage();$i++)
                <li class="page-item {{ $students->currentPage() == $i ? 'active' : '' }} "><a class="page-link" href="{{ $students->url($i) }}">{{ $i }}</a></li>
                @endfor
                <li class="page-item {{ $students->nextPageUrl() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $students->nextPageUrl() }}" aria-disabled="{{ $students->nextPageUrl() ? 'false' : 'true' }}">Next</a>
                </li>
        </ul>
    </nav>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#export-btn').click(function() {
            $.ajax({
                url: '/dashboard/events/' + '{{ $event->id }}' + '/students/export',
                method: 'GET',
                action: 'exportStudents',
                success: function(data) {
                    var csvData = new Blob([data], {
                        type: 'text/csv;charset=utf-8;'
                    });
                    var csvUrl = URL.createObjectURL(csvData);
                    var link = document.createElement('a');
                    link.href = csvUrl;
                    link.download = 'students.csv';
                    link.style.display = 'none';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
        $('#btn-certificate').click(function() {
            var id = $(this).closest('tr').data('id');
            $.ajax({
                url: '/dashboard/events/' + '{{ $event->id }}' + '/students/' + id + '/certificate',
                method: 'GET',
                action: 'getCertificate',
                success: function(data) {
                    var csvData = new Blob([data], {
                        type: 'text/csv;charset=utf-8;'
                    });
                    var csvUrl = URL.createObjectURL(csvData);
                    var link = document.createElement('a');
                    link.href = csvUrl;
                    link.download = 'students.csv';
                    link.style.display = 'none';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    console.log(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>
@endsection