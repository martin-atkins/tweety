<x-app>
	<header class="mb-6" style="position: relative;">
		<div class="relative">
			<img
				src="/images/bugs-bunny.jpg"
				alt=""
				class="rounded-lg mb-2"
			>

	        <img
	            src="{{ $user->avatar }}"
	            alt=""
	            class="rounded-full mr-2 absolute bottom-0
	            	   transform -translate-x-1/2 translate-y-1/2"
	            width="150"
	            style="left: 50%;"
	        >
    	</div>
		<div class="flex justify-between items-center mb-6">
			<div style="max-width: 270px">
				<h2 class="font-bold text-2xl mb-0">{{ $user->name }}</h2>
				<p class="text-sm">Joined {{ $user->created_at->diffForHumans() }}</p>
			</div>

			<div class="flex">
				@can ('edit', $user)
					<a
						href="{{ $user->path('edit') }}"
						class="rounded-full border border-gray-300 py-2 px-4 text-black text-sm mr-2"
					>
						Edit Profile
					</a>
				@endcan

				<!-- Created an annonymous Blade component to handle the button -->
				<x-follow-button :user="$user"></x-follow-button>
			</div>
		</div>

		<p class="text-sm">
			Bugs is an anthropomorphic gray and white rabbit or hare who is famous for his
			flippant, insouciant personality. He is also characterized by a Brooklyn
			accent, his portrayal as a trickster, and his catch phrase "Eh...What's up,
			doc?"
		</p>

	</header>

    @include('_timeline', [
    	'tweets' => $tweets
    ])
</x-app>