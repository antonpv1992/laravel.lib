@if(session('success'))
  @include('components/alert')
@endif
<div class="library row pt-2 mt-4">
  @forelse ($books as $book)
    <div class="library__book col-3 mb-4">
      <div class="library__card card">
        @if(Auth::user() && Auth::user()->hasRole('admin'))
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
        @endif
        <h5 class="library__card-title card-title card-header d-flex">
          <a class="text-decoration-none text-dark" href="{{ Route('book', $book->id)}}">
            <span>{{ $book->title }}</span>
          </a>
        </h5>
        <a href="{{ Route('book', $book->id)}}">
          <img src="{{ $book->image }}" class="library__card-image card-img-top" alt="...">
        </a>
      </div>
      <ul class="library__card-desc list-group list-group-flush">
        <li class="card__item list-group-item">{{ $book->description }}</li>
        <li class="card__collapse collapse" id="card{{ $book->id }}">
          <ul class="card__list list-group list-group-flush">
            <li class="card__desc-item list-group-item">
              <span class="card__desc-title fw-bold">Author:</span> {{ $book->author }}
            </li>
            <li class="card__desc-item list-group-item">
              <span class="card__desc-title fw-bold">Genre:</span> {{ $book->genre }}
            </li>
            <li class="card__desc-item list-group-item">
              <span class="card__desc-title fw-bold">Year:</span> {{ $book->year }}
            </li>
            <li class="card__desc-item list-group-item">
              <span class="card__desc-title fw-bold">Country:</span> {{ $book->country }}
            </li>
            <li class="card__desc-item list-group-item">
              <span class="card__desc-title fw-bold">Pages:</span> {{ $book->pages }}
            </li>
          </ul>
        </li>
      </ul>
      <div class="library__card-button card">
        <a class="library__button btn border border-primary" data-bs-toggle="collapse" href="#card{{ $book->id }}" role="button" aria-expanded="false" aria-controls="card{{ $book->id }}">
          <i class="library__button-icon fa fa-arrow-circle-down text-primary" aria-hidden="true"></i>
        </a>
        <a href="{{ Route('book', $book->id)}}" class="library__button btn btn-primary">Read</a>
      </div>
    </div>
  @empty
    <div class="library__book col-sm-3 mb-3 mx-auto text-center">
      <p class="">No Books</p>
    </div>
  @endforelse
</div>
<div class="library__pagination col-3 mx-auto">
  {{ $books->links() }}
</div>