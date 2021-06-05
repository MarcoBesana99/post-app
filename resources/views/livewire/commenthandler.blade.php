<div class="border border-primary border-right-0 border-left-0 border-bottom-0 mt-3">
    <div>
        <div class="d-flex justify-content-between">
            <div>{{ $totalNumberOfComments }} comments</div>
            @if ($showMore)
                <a wire:click="showMore" class="show-link">Show More</a>
            @else
                @if ($showLess)
                    <a wire:click="showLess" class="show-link">Show Less</a>
                @endif
            @endif
        </div>
        @foreach ($comments as $comment)
            <div class="mt-3">
                <h5 class="font-weight-bold username">{{ $comment->user->name }}</h5>
                <p>{{ $comment->content }}</p>
            </div>
        @endforeach
    </div>
    @auth
        <form wire:submit.prevent="submitComment">
            <textarea rows="1" wire:model="content" class="form-control textarea mt-3 bg-light"></textarea>
            @error('content') <div class="alert alert-danger mt-3" role="alert">{{ $message }}</div> @enderror

            <button type="submit" class="mt-3 btn btn-block"
                style="background-color: #0D00A4; color: white;">Comment</button>
        </form>
    @endauth
</div>
