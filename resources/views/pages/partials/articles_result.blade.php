<div class="result">
    <h2 class="title">

        <a href="{{route('article.show',$article->id)}}">{{ $article->title }}</a>

        <small>by</small>

        <a href="{{ route('users.show', [$article->user_id]) }}" title="{{ $article->user->name }}">
            <img class="avatar avatar-small" alt="{{ $article->user->name }}" src="{{ $article->user->avatar }}"/>
            <small>{{ $article->user->name }}</small>
        </a>

    </h2>
    <div class="info">
  <span class="url">
        <a href="{{route('article.show',$article->id)}}">{{route('article.show',$article->id)}}</a>
  </span>
        <span class="date" title="Last Updated At">
      {{ Carbon\Carbon::parse($article->created_at)->format('Y-m-d') }}


  </span>

    </div>
    <div class="desc">
        {{ str_limit($article->body, 250) }}
    </div>
    <hr>
</div>

