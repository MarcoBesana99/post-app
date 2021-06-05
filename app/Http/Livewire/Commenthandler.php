<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class Commenthandler extends Component
{
    public $post;
    public $content;
    public $amount = 3;

    protected $rules = [
        'content' => 'required|min:10'
    ];

    public function submitComment()
    {
        $this->validate($this->rules);

        $comment = new Comment;
        $comment->content = $this->content;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $this->post->id;
        $comment->save();
    }

    public function render()
    {
        $allComments = Comment::where('post_id', $this->post->id);
        $comments = $allComments->orderBy('created_at', 'desc')->take($this->amount)->get();
        $totalNumberOfComments = $allComments->count();
        $showMore = true;
        $showLess = false;
        if ($this->amount >= $totalNumberOfComments) {
            $showMore = false;
            $showLess = True;
        }
        if ($totalNumberOfComments == 0) {
            $showMore = false;
            $showLess = false;
        }
        elseif ($totalNumberOfComments <=3) {
            $showMore = false;
            $showLess = false;
        }
        return view('livewire.commenthandler', compact('comments', 'showMore', 'showLess', 'totalNumberOfComments'));
    }

    public function showMore()
    {
        $this->amount += 3;
    }

    public function showLess()
    {
        $this->amount = 3;
    }
}
