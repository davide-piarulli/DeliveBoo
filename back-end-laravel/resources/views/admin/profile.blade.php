@extends('layouts.admin')



@section('title')
 - Profilo
@endsection



@section('content')

<div class="container text-center">
  <h1 class="mb-5">Ciao {{Auth::user()->name}}!</h1>
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia laboriosam, voluptas ipsum animi, ut dolores nisi maiores eos asperiores exercitationem natus ducimus id maxime pariatur minima. Quis veritatis quam sapiente quaerat corrupti cumque harum perferendis odio fuga aliquam amet incidunt dolores quod perspiciatis sit maxime voluptates, velit eveniet repudiandae deleniti. Fugiat iure quam repellat, necessitatibus eaque reiciendis commodi suscipit architecto, soluta debitis voluptatem! Provident incidunt a, molestias sint maxime cumque autem natus ullam doloremque, alias saepe consequuntur eum ab deleniti harum omnis commodi animi maiores aperiam nemo reprehenderit, mollitia ad dolor rerum. Alias vel error ratione ipsa, sapiente corrupti provident!</p>
</div>

@endsection
