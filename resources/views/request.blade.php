<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- 00. Navbar -->
    <x-navbar/>
    <div class="modal fade" id="inputFormModal" tabindex="-1" aria-labelledby="inputFormModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="inputFormModalLabel">Input Form Modal</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- Form inside the modal -->
              <form action="{{ route('request.post') }}" method="POST">
                @csrf 
                <div class="mb-3">
                  <label for="id_user" class="form-label">Select Approver</label>
                  <select name="id_user" id="id_user" class="form-control">
                    @foreach ($userData as $item => $value)
                        <option value="{{ $item }}">{{ $value }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3">
                  <label for="id_driver" class="form-label">Select Driver</label>
                  <select name="id_driver" id="id_driver" class="form-control">
                    @foreach ($driverData as $item => $value)
                        <option value="{{ $item }}">{{ $value }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3">
                    <label for="id_vehicle" class="form-label">Select Vehicle</label>
                    <select name="id_vehicle" id="id_vehicle" class="form-control">
                      @foreach ($vehicleData as $item => $value)
                          <option value="{{ $item }}">{{ $value }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="fuel_usage" class="form-label">Fuel Usage</label>
                        <input type="number" class="form-control" id="fuel_usage" name="fuel_usage" required value="{{ old('fuel_usage') }}">
                      </div>
                    </div>
                <div class="mb-3">
                        <label for="used_at" class="form-label">Request Date</label>
                        <input type="date" class="form-control" id="used_at" name="used_at" value="{{ old('used_at') }}" required>
                    </div>  
                <div class="mb-3">
                        <label for="returned_at" class="form-label">Return Date</label>
                        <input type="date" class="form-control" id="returned_at" name="returned_at" value="{{ old('returned_at') }}" required>
                    </div>       
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Submit</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    <div class="container mt-4">
        <!-- 01. Content-->
        <h1 class="text-center mb-4">Request List</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inputFormModal">
            Tambah Request
          </button>
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Driver</th>
                            <th>Vehicle</th>
                            <th>Status</th>
                            <th>Details</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->id_user }}</td>
                                <td>{{ $item->id_driver }}</td>
                                <td>{{ $item->id_vehicle }}</td>
                                <td>{{ ucfirst($item->status) }}</td>
                                <td>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Fuel Usage</th>
                                                <th>Used At</th>
                                                <th>Returned At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($item->details as $detail)
                                                <tr>
                                                    <td>{{ $detail->fuel_usage }}</td>
                                                    <td>{{ $detail->used_at }}</td>
                                                    <td>{{ $detail->returned_at }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <form action="{{ route('request.delete', [$item->id,$item->id_driver,$item->id_vehicle]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $loop->index }}">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                            <!-- Edit form (collapsed by default) -->
                            <tr class="collapse" id="collapse-{{ $loop->index }}">
                                <td colspan="6">
                                    <form action="{{ route('request.update', [$item->id,$item->id_driver,$item->id_vehicle]) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <div class="mb-3">
                                            <label for="admin_approval" class="form-label">Admin Approval</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="admin_approval" value="approved" required>
                                                <label class="form-check-label" for="approved">
                                                    Approve
                                                </label>    
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="admin_approval" value="rejected" required>
                                                <label class="form-check-label" for="rejected">
                                                    Reject
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="approver_approval-{{ $item->id }}" class="form-label">Approver Approval</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="approver_approval" value="approved" required>
                                                <label class="form-check-label" for="approved">
                                                    Approve
                                                </label>    
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="approver_approval" value="rejected" required>
                                                <label class="form-check-label" for="rejected">
                                                    Reject
                                                </label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-outline-primary">Update</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
