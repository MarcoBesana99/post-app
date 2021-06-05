<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Posthandler extends Component
{
    use WithFileUploads;

    public $title;
    public $postContent;
    public $images_path = [];
    public $amount = 5;
    public $search;

    protected $rules = [
        'title' => 'required|min:6',
        'postContent' => 'required|min:10',
        'images_path.*' => 'image',
    ];

    public function submitPost()
    {
        $this->validate($this->rules);

        $post = new Post;
        $post->title = $this->title;
        $post->content = $this->postContent;
        foreach ($this->images_path as $key => $image) {
            $this->images_path[$key] = $image->store('img', 'public');
        }
        $post->images_path = json_encode($this->images_path);
        $post->user_id = Auth::user()->id;
        $post->save();

        $this->title = null;
        $this->postContent = null;
        $this->images_path = null;
    }

    public function deletePost(Post $post)
    {
        $post->delete();
    }

    public function render()
    {
        $allPosts = new Post();
        $showMore = true;
        $showLess = false;
        $posts = $allPosts->where('title', 'like', $this->search . '%')->orderBy('created_at', 'DESC');
        $totalNumberOfPosts = $posts->count();
        $posts = $posts->take($this->amount)->get();
        if ($this->amount >= $totalNumberOfPosts) {
            $showMore = false;
            $showLess = True;
        }
        if ($totalNumberOfPosts <= 5) {
            $showMore = false;
            $showLess = false;
        }
        $user = Auth::user();
        return view('livewire.posthandler', compact('posts', 'user', 'showMore', 'showLess'));
    }

    public function load()
    {
        $this->amount += 5;
    }

    public function showLess()
    {
        $this->amount = 5;
    }
}
