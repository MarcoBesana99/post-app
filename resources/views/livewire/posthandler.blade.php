<div>
    @auth
        <div class="card p-4">
            <form wire:submit.prevent="submitPost" enctype="multipart/form-data">
                <input type="text" wire:model.lazy="title" class="form-control bg-light" placeholder="Title of the post">
                @error('title') <div class="alert alert-danger mt-3" role="alert">{{ $message }}</div> @enderror

                <textarea rows="3" wire:model.lazy="postContent" class="form-control mt-3 bg-light"
                    placeholder="Content of the post"></textarea>
                @error('postContent') <div class="alert alert-danger mt-3" role="alert">{{ $message }}</div> @enderror
                <div class="form-group" style="position: relative;">
                    <div style="cursor: pointer;">
                        <label for="images_path" class="image-btn text-center">Upload images</label>
                    </div>
                    <input type="file" wire:model="images_path" class="form-control mt-3" multiple />
                </div>
                @error('images_path.*') <div class="alert alert-danger mt-3" role="alert">{{ $message }}</div>@enderror

                <button type="submit" class="mt-3 btn btn-block" style="background-color: #0D00A4; color: white;">Submit the
                    post</button>
            </form>
        </div>
    @endauth

    <input type="text" class="form-control mt-4" wire:model.debounce.500ms="search"
        placeholder="Search your favourite post">
    <div class="btn btn-primary btn-block mt-4 text-center" wire:loading.flex wire:target="search">
        Searching
    </div>
    <div wire:loading.remove wire:target="search">
        @foreach ($posts as $post)
            <div class="card mt-3 border border-primary p-4">
                <div class="d-flex align-items-end flex-column">
                    <h5 class="font-weight-bold username">{{ $post->user->name }}</h5>
                    <p class="date">{{ $post->created_at->format('d-m-Y H:i') }}</p>
                </div>
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->content }}</p>
                @if ($post->images_path != null)
                    <div class="row">
                        @foreach (json_decode($post->images_path) as $image)
                            <div class="col-6">
                                <img class="img-fluid" src="{{ asset('public/storage/' . $image) }}" alt="">
                            </div>
                        @endforeach
                    </div>
                @endif
                <livewire:liker :key="time() . $post->id" :post="$post" :user="$user">
                    <livewire:commenthandler :key="time() . $post->id" :post="$post">
                        @if ($post->user == auth()->user())
                            <button wire:click="deletePost({{ $post }})"
                                class="btn btn-danger mt-3 w-25">Delete</button>
                        @endif
            </div>
        @endforeach
        @if ($showMore)
            <a wire:click="load" class="btn btn-primary btn-block mt-4">Load More</a>
            <div class="btn btn-primary btn-block mt-3" wire:loading.flex>
                Searching
            </div>
        @else
            @if ($showLess)
                <a wire:click="showLess" class="btn btn-primary mt-4 btn-block">Show Less</a>
            @endif
        @endif
    </div>
</div>
