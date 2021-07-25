<!--<meta name="csrf-token" content="{{-- csrf_token() --}}">-->
<div class="users container mt-3 pt-3 pb-2">
  <div class="users__form d-flex justify-content-around">
    <label class="users__input form-input col-5">
      <input type="text" class="users__search form-control" name="usearch" placeholder="Title">
    </label>
    <div class="users__filter col-5">
      <select class="users__select form-select" name="ufilter" aria-label=".form-select-sm example">
        <option class="users__option" value="id" selected>Id</option>
        <option class="users__option" value="login">User name</option>
        <option class="users__option" value="email">Email</option>
        <option class="users__option" value="name">Name</option>
        <option class="users__option" value="surname">Surname</option>
        <option class="users__option" value="age">Age</option>
      </select>
    </div>
  </div>
  <table class="users__table table table-striped">
    <thead class="users__table-head">
    <tr class="users__table-row">
      <th class="users__table-col" scope="col"><a class="text-decoration-none text-dark">#</a></th>
      <th class="users__table-col" scope="col"><a class="text-decoration-none text-dark">User name</a></th>
      <th class="users__table-col" scope="col"><a class="text-decoration-none text-dark">Email</a></th>
      <th class="users__table-col" scope="col"><a class="text-decoration-none text-dark">Name</a></th>
      <th class="users__table-col" scope="col"><a class="text-decoration-none text-dark">Surname</a></th>
      <th class="users__table-col" scope="col"><a class="text-decoration-none text-dark">Age</a></th>
    </tr>
    </thead>
    <tbody class="users__table-body">
    @forelse ($users as $user)
    <tr class="users__table-row">
      <th class="users__table-col" scope="row">{{ $user->id  }}</th>
      <td class="users__table-col"><a class="text-decoration-none text-dark" href="{{route('profile', $user->login)}}">{{ $user->login }}</a></td>
      <td class="users__table-col">{{ $user->email }}</td>
      <td class="users__table-col">{{ $user->name }}</td>
      <td class="users__table-col">{{ $user->surname }}</td>
      <td class="users__table-col">{{ $user->age }}</td>
    </tr>
  @empty
    <tbody class="col-sm-3 mb-3 mx-auto text-center">
      <tr class="users__table-row">
        <td class="users__table-col" colspan="6">
          No Users
        </td>
      </tr>
  @endforelse
    </tbody>
  </table>
</div>
