<div class="result">
    <h2 class="title">

        <a href="{{ $topic->link() }}">{{ $topic->title }}</a>

        <small>by</small>

        <a href="{{ route('users.show', [$topic->user_id]) }}" title="{{ $topic->user->name }}">
            <img class="avatar avatar-small" alt="{{ $topic->user->name }}" src="{{ $topic->user->avatar }}"/>
            <small>{{ $topic->user->name }}</small>
        </a>

    </h2>
    <div class="info">
  <span class="url">
        <a href="{{ $topic->link() }}">{{ $topic->link() }}</a>
  </span>
        <span class="date" title="Last Updated At">
      {{ Carbon\Carbon::parse($topic->created_at)->format('Y-m-d') }}


  </span>

    </div>
    <div class="desc">
        {{ str_limit($topic->body, 250) }}
    </div>
    <hr>
</div>

