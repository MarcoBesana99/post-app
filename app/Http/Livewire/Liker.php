<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use LamaLama\Wishlist\Wishlistable;
use Illuminate\Support\Facades\Auth;
use LamaLama\Wishlist\Wishlist;

class Liker extends Component
{
    use Wishlistable;

    public $post;

    public $user;


    public function like() {
        if ($this->user) {
            $liked = $liked = $this->user->hasWished($this->post->id, $this->user->id);
        
            if($liked == false) {
                $this->user->wish($this->post, $this->post->title);
            }
            else {
                $this->user->unwish($this->post, $this->post->title);
            }
        }
    }
        
    public function render()
    {
        $class = '';
        if ($this->user) {
            $liked = $this->user->hasWished($this->post->id, $this->user->id);
            $liked == false ? $class = 'far' : $class = 'fas';
        }
        else {
            $liked = false;
            $class = 'fas';
        }
        $numberLikes = $this->post->wishNumber($this->post->id);
        return view('livewire.liker', compact('numberLikes','liked','class'));
    }
}
