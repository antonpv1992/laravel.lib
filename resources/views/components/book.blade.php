@if(Auth::user() && Auth::user()->hasRole('admin'))
<div class="book my-3">
  <form action="{{ Route('delete', $book->id)}}" method="post">
    @csrf
    @method('DELETE')
    <button type="button" class="library__book-close" data-bs-toggle="modal" data-bs-target="#deleteBook">
      <i class="library__card-icon fas fa-times"></i>
    </button>
    @include('components/delete-modal')
  </form>
  <a type="button" class="library__book-edit" href="{{ Route('edit', $book->id)}}">
    <i class="library__card-icon fas fa-pencil-alt"></i>
  </a>
</div>
@endif
@if(session('success'))
  @include('components/alert')
@endif
<h5 class="book__title card-title text-center my-3">{{ $book->title }}</h5>
<div class="book__picture col-sm-4 ms-auto me-auto">
  <img src="{{ $book->image }}" class="book__image card-img-top " alt="...">
</div>
<div class="book__full container col-10 ms-auto me-auto my-3">
  <p class="book__inner mt-3">
    {{ $book->book }}
  </p>
</div>