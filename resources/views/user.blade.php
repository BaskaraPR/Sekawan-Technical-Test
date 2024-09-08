<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Table</title>
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
          <form action="{{ route('user.post') }}" method="POST">
            @csrf 
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="roles" class="form-label">Select Role</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="roles" value="admin" required>
                    <label class="form-check-label" for="admin">
                        Admin
                    </label>    
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="roles" value="approver" required>
                    <label class="form-check-label" for="approver">
                        Approver
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
        <h1 class="text-center mb-4">User List</h1>
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
                        <form id="user-form" action="" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search" value="" 
                                    placeholder="Search User">
                                <button class="btn btn-secondary" type="submit">
                                    Cari
                                </button>
                            </div>
                        </form>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inputFormModal">
                            Tambah User
                          </button>
                          <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ ucfirst($item->roles) }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <!-- Delete Button -->
                                                <form action="{{ route('user.delete', ['id' => $item->id]) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
                                            <form action="{{ route('user.update', ['id' => $item->id]) }}" method="POST">
                                                @csrf
                                                @method('put')
                                                <div class="mb-3">
                                                    <label for="name-{{ $item->id }}" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="name-{{ $item->id }}" name="name" value="{{ $item->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email-{{ $item->id }}" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email-{{ $item->id }}" name="email" value="{{ $item->email }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="roles-{{ $item->id }}" class="form-label">Role</label>
                                                    <select class="form-select" id="roles-{{ $item->id }}" name="roles" required>
                                                        <option value="admin" {{ $item->roles == 'admin' ? 'selected' : '' }}>Admin</option>
                                                        <option value="approver" {{ $item->roles == 'approver' ? 'selected' : '' }}>Approver</option>
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