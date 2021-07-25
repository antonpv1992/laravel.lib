<div class="modification mt-5 mb-4">
  @include('components/errors')
  <form class="modification__form col-sm-8 ms-auto me-auto pt-3 pb-2" method="post" action="@if(Route::current()->getName() === 'add'){{route('create')}}@else{{route('change', $book->id)}}@endif" enctype="multipart/form-data">
    @csrf
    @isset($book) @method('PATCH') @endisset
    <label class="modification__input form-input mb-3">
      <input type="text" class="modification__control form-control" name="title" placeholder="Title" value="@isset($book) {{ $book->title }} @endisset" required>
    </label>
    <label class="modification__input form-input mb-3">
      <input type="text" class="modification__control form-control" name="description" placeholder="Description" value="@isset($book) {{ $book->description }} @endisset" required>
    </label>
    <label class="modification__input form-input mb-3">
      <input type="file" class="modification__control form-control" name="image" placeholder="Image" value="">
    </label>
    <label class="modification__input form-input mb-3">
      <input type="text" class="modification__control form-control" name="author" placeholder="Author" value="@isset($book) {{ $book->author }} @endisset" required>
    </label>
    <label class="modification__input form-input mb-3">
      <input type="text" class="modification__control form-control" name="genre" placeholder="Genre" value="@isset($book) {{ $book->genre }} @endisset" required>
    </label>
    <label class="modification__input form-input mb-3">
      <input type="number" class="modification__control form-control" name="year" placeholder="Year" value="@isset($book){{ $book->year }}@endisset" required>
    </label>
    <label class="modification__input form-input mb-3">
      <input type="text" class="modification__control form-control" name="country" placeholder="Country" value="@isset($book) {{ $book->country }} @endisset" required>
    </label>
    <label class="modification__input form-input mb-3">
      <input type="number" class="modification__control form-control" name="pages" placeholder="Pages" value="@isset($book){{ $book->pages }}@endisset" required>
    </label>
    <label class="modification__input form-input mb-3 ">
      <textarea class="modification__control form-control" rows="10" name="book" placeholder="Book" required>@isset($book) {{ $book->book }} @endisset</textarea>
    </label>
    <label class="modification__input form-input mb-3 text-center">
      <button type="submit" class="modification__button btn btn-primary">Submit</button>
    </label>
  </form>
</div>