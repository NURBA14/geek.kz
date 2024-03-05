<div class="sidebar">
    <div class="widget">
        <h2 class="widget-title">Popular Posts</h2>
        <div class="blog-list-widget">
            <div class="list-group">
                @foreach ($popular_posts as $post)
                    <a href="{{ route('posts.single', ['slug' => $post->slug]) }}"
                        class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="w-100 justify-content-between">
                            <img src="{{ asset($post->getImage()) }}" alt="" class="img-fluid float-left"
                                style="width: 100px">
                            <h5 class="mb-1">{{ $post->title }}</h5>
                            <small>{{ $post->getPostDate() }}</small>
                            <small>{{ $post->views }}<i class="fa fa-eye"></i></small>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="widget">
        <h2 class="widget-title">Popular Categories</h2>
        <div class="link-widget">
            <ul>
                @foreach ($popular_categories as $category)
                    <li><a href="{{ route('categories.single', ['slug' => $category->slug]) }}">{{ $category->title }}
                            <span>({{ $category->posts_count }})</span></a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="widget">
        <h2 class="widget-title">Popular tags</h2>
        <div class="link-widget">
            <ul>
                @foreach ($popular_tags as $tag)
                    <li><a
                            href="{{ route('tag.single', ['slug' => $tag->slug]) }}">{{ $tag->title }}<span>({{ $tag->posts_count }})</span></a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
