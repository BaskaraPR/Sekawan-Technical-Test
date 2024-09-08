<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Table</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <!-- 00. Navbar -->
    <x-navbar/>
    <!-- Modal -->
<div class="modal fade" id="inputFormModal" tabindex="-1" aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="inputFormModalLabel">Input Form Modal</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Form inside the modal -->
          <form action="{{ route('vehicle.post') }}" method="POST">
            @csrf 
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">License Plate</label>
              <input type="text" class="form-control" id="licensePlate" name="licensePlate" required value="{{ old('licensePlate') }}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" required value="{{ old('description') }}">
              </div>
              <div class="mb-3">
                <label for="ownership" class="form-label">Select Ownership</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="ownership" value="owned" required>
                    <label class="form-check-label" for="owned">
                        Owned
                    </label>    
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="ownership" value="third_party" required>
                    <label class="form-check-label" for="third_party">
                        Third Party
                    </label>
                </div>
            </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Select Type</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" value="cargo" required>
                        <label class="form-check-label" for="cargo">
                            Cargo
                        </label>    
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" value="passenger" required>
                        <label class="form-check-label" for="passenger">
                            Passenger
                        </label>
                    </div>
                </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Select Status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="available" required>
                            <label class="form-check-label" for="available">
                                Available
                            </label>    
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="unavailable" required>
                            <label class="form-check-label" for="unavailable">
                                Unavailable
                            </label>
                        </div>
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
        <h1 class="text-center mb-4">Vehicle List</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
             <div class="card mb-3">
                
                <div class="card-body">
                    @if (session('Success'))
                        <div class="alert alert-success">
                            {{ session('Success') }}    
                        </div>   
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors ->all() as $error)
                                    <li>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                   
                <div class="card">
                    <div class="card-body">
                        <!-- 03. Searching -->
                        <form id="vehicle-form" action="" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search" value="" 
                                    placeholder="Search vehicle">
                                <button class="btn btn-secondary" type="submit">
                                    Cari
                                </button>
                            </div>
                        </form>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inputFormModal">
                            Tambah vehicle
                          </button>
                          <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>License Plate</th>
                                    <th>Description</th>
                                    <th>Ownership</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->licensePlate }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ ucfirst($item->ownership) }}</td>
                                        <td>{{ ucfirst($item->type) }}</td>
                                        <td>{{ ucfirst($item->status) }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <!-- Delete Button -->
                                                <form action="{{ route('vehicle.delete', ['id' => $item->id]) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                                <!-- Edit Button -->
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $loop->index }}">
                                                    Edit
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Edit form (collapsed by default) -->
                                    <tr class="collapse" id="collapse-{{ $loop->index }}">
                                        <td colspan="4">
                                            <form action="{{ route('vehicle.update', ['id' => $item->id]) }}" method="POST">
                                                @csrf
                                                @method('put')
                                                <div class="mb-3">
                                                    <label for="name-{{ $item->id }}" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="name-{{ $item->id }}" name="name" value="{{ $item->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="licensePlate-{{ $item->id }}" class="form-label">License Plate</label>
                                                    <input type="text" class="form-control" id="licensePlate-{{ $item->id }}" name="licensePlate" value="{{ $item->licensePlate }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description-{{ $item->id }}" class="form-label">Description</label>
                                                    <input type="text" class="form-control" id="description-{{ $item->id }}" name="description" value="{{ $item->description }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="ownership-{{ $item->id }}" class="form-label">Ownership</label>
                                                    <select class="form-select" id="ownership-{{ $item->id }}" name="ownership" required>
                                                        <option value="owned" {{ $item->ownership == 'owned' ? 'selected' : '' }}>Owned</option>
                                                        <option value="third_party" {{ $item->ownership == 'third_party' ? 'selected' : '' }}>Third Party</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="type-{{ $item->id }}" class="form-label">Type</label>
                                                    <select class="form-select" id="type-{{ $item->id }}" name="type" required>
                                                        <option value="cargo" {{ $item->type == 'cargo' ? 'selected' : '' }}>Cargo</option>
                                                        <option value="passenger" {{ $item->type == 'passenger' ? 'selected' : '' }}>Passenger</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status-{{ $item->id }}" class="form-label">Status</label>
                                                    <select class="form-select" id="status-{{ $item->id }}" name="status" required>
                                                        <option value="available" {{ $item->status == 'available' ? 'selected' : '' }}>Available</option>
                                                        <option value="unavailable" {{ $item->status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-outline-primary">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                        </ul>       
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (popper.js included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>