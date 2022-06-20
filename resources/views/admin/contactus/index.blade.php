@extends('admin.layout')
@section('content')
     
    <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
          <h5 class="card-title mb-0">Contact List</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                  <thead>
                      <tr>
                          <th class="no-sort">#</th>
                          <th>Name</th>
                          <th>Role</th>
                          <th>Class Name</th>
                          <th>Email</th>
                          <th>Mobile</th>
                          <th>City</th>
                          <th>How Know Us</th>
                          <th>Message</th>
                      </tr>
                      </thead>
                    <tbody>
                      @if(!empty($contacts)) 
                      @foreach($contacts as $key => $contact)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->role ? "Class" : "Student" }}</td>
                        <td>{{ $contact->classname ? $contact->classname : "N/A" }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->mobile }}</td>
                        <td>{{ $contact->city_name }}</td>
                        <td>{{ $contact->title }}</td>
                        <td>{{ $contact->msg }}</td>
                      </tr>
                      @endforeach
                      @endif
                  </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
@endsection