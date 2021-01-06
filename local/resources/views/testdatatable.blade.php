<html lang="en">
<head>
    <title>Laravel DataTables Tutorial Example</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
</head>
      <body>
         <div class="container">
               <h2>Laravel DataTables Tutorial Example</h2>
            <table class="table table-bordered" id="table">
               <thead>
                  <tr>
                     <th>Id</th>
                     <th>Name</th>
                  </tr>
               </thead>
            </table>
         </div>

         @foreach($doctor as $out_doctor)
         <div class="modal fade" id="exampleModal{{ $out_doctor->ID }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Doctor ID : {{ $out_doctor->ID }}</h5>
                </div>
                <div class="modal-body">
                  {{ $out_doctor->Name }}
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
          @endforeach


       <script>
         $(function() {
               $('#table').DataTable({
               processing: true,
               serverSide: true,
               ajax: '{{ url('testdatatable_table') }}',
               columns: [
                        { data: 'ID', name: 'ID' },
                        { data: 'Name', name: 'Name' }
                     ]
            });
         });
         </script>
   </body>
</html>


<td>
    <a href="{{ url('employee/edit/').'/'.$out_data_Employee->ID_user }}">
        <button class="btn btn-warning" style="padding:10px;">
            &nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;
        </button>
    </a>
    <button class="btn btn-danger" data-toggle="modal" data-target="#DELETE{{ $out_data_Employee->ID  }}" style="padding:10px;">
         Delete
    </button>
</td>
