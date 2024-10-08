@props(['post_id', 'text'])

@if ($post = \Modules\Blog\Models\Article::find($post_id))
    <a
        class="block relative aspect-[4/3] border bg-gray-100"
        href="{{ $this->url('show',['record'=>$post]) }}"
    >
        <img
            class="absolute top-0 left-0 w-full h-full p-0 m-0 opacity-20 object-center object-cover"
            src="{{-- $post->getMainImage() --}}"
            alt=""
        >
        <div class="relative z-1 p-4">
            {{ $text ?: $post->title }}
        </div>
    </a>
@endif
